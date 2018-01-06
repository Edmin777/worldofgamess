<?php 
if ($Module == 'logout' and $_SESSION['USER_LOGIN_IN']) {
if ($_COOKIE['user']) {
setcookie('user', '', strtotime('-30 days'), '/');
unset($_COOKIE['user']);
}
session_unset();
Location('/login');
}


function CheckRegInfo($p1, $p2) { //где $p1 - логин пользователя, $p2 - email пользователя
	global $CONNECT;
	if (mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `login` = '$p1'"))) 
			MessageSend(1, 'Логин <b>'.$_POST['login'].'</b> уже используется.');
	else if (mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `email` FROM `users` WHERE `email` = '$p2'"))) 
			MessageSend(1, 'E-Mail <b>'.$_POST['email'].'</b> уже используется.');
}

function MIX($p1) {
	return md5($p1.date('d.m.Y H').'73673282'); //функция генерирует новый код каждый час, тоесть - у вас будет всего 1 час, чтобы активировать email.
}


function checkLogin($p1) {
if (!preg_match('/^[A-Za-z-0-9]{2,15}$/', $p1))
	MessageSend(1, 'Логин должен содержать не менее 3 и не более 15 латинских символов или цифр');
}


function checkPassword($p1) {
if (!preg_match('/^[A-Za-z-0-9]{5,15}$/', $p1))
	MessageSend(1, 'Пароль должен содержать не менее 5 и не более 15 латинских символов или цифр');
}


function checkCaptcha($p1) {
if (!preg_match('/^[0-9]{1,6}$/', $p1))
	MessageSend(1, 'Капча должна содержать только цифры, не менее 1 и не более 6.');
}

function checkEmail($p1) {
if (!preg_match('/^([A-z0-9_\.-]+)@([A-z0-9_\.-]+)\.([A-z\.]{2,6})$/', $p1)) 
	MessageSend(1, 'E-mail указан неверно.');
}

function checkName($p1) {
if (!preg_match('/^[А-я]{3,15}$/u', $p1)) 
	MessageSend(1, 'Имя должно содержать не менее 3 и не более 15 русских букв.');
}

function checkRace($p1) {
if (!preg_match('/^[0-9]{1,11}$/', $p1))
	MessageSend(1, 'Раса указана неверно.');
}

function checkProvince($p1) {
if (!preg_match('/^[0-9]{1,11}$/', $p1))
	MessageSend(1, 'Провинция указана неверно.');
}

if ($Module == 'edit' and $_POST['enter']) {
	ULogin(1);

	checkName($_POST['name']);
	checkRace($_POST['race']);
	checkProvince($_POST['province']);
	

if ($_POST['opassword'] or $_POST['npassword']) {
	
	checkPassword($_POST['opassword']);
	checkPassword($_POST['npassword']);
	
if ($_SESSION['USER_PASSWORD'] != GenPass($_POST['opassword'], $_SESSION['USER_LOGIN']))
	MessageSend(3, 'Старый пароль указан неверно.');
$Password = GenPass($_POST['npassword'], $_SESSION['USER_LOGIN']);
mysqli_query($CONNECT, "UPDATE `users` SET `password` = '$Password' WHERE `id` = $_SESSION[USER_ID]");
	$_SESSION['USER_PASSWORD'] = $Password;
}

if ($_POST['name'] != $_SESSION['USER_NAME']) {
mysqli_query($CONNECT, "UPDATE `users` SET `name` = '$_POST[name]' WHERE `id` = $_SESSION[USER_ID]");
$_SESSION['USER_NAME'] = $_POST['name'];
}

if (UserRace($_POST['race']) != $_SESSION['USER_RACE']) {
mysqli_query($CONNECT, "UPDATE `users` SET `race` = $_POST[race] WHERE `id` = $_SESSION[USER_ID]");
$_SESSION['USER_RACE'] = UserRace($_POST['race']);
}

if (UserProvince($_POST['province']) != $_SESSION['USER_PROVINCE']) {
mysqli_query($CONNECT, "UPDATE `users` SET `province` = $_POST[province] WHERE `id` = $_SESSION[USER_ID]");
$_SESSION['USER_PROVINCE'] = UserProvince($_POST['province']);
}

if ($_FILES['avatar']['tmp_name']) {
if ($_FILES['avatar']['type'] != 'image/jpeg') 
MessageSend(2, 'Неверный тип изображения');
if ($_FILES['avatar']['size'] > 200000) 
MessageSend(2, 'Размер изображения не должен превышать 195 кб!');

$Image = imagecreatefromjpeg($_FILES['avatar']['tmp_name']);
$Size = getimagesize($_FILES['avatar']['tmp_name']);
$Tmp = imagecreatetruecolor(120, 120);
imagecopyresampled($Tmp, $Image, 0, 0, 0, 0, 120, 120, $Size[0], $Size[1]);

if ($_SESSION['USER_AVATAR'] == 0) {
	
$Files = glob('resource/avatar/*', GLOB_ONLYDIR);
foreach($Files as $Num => $Dir) {
$Num++;
$Count = sizeof(glob($Dir.'/*.*'));
if ($Count < 250) {
$Download = $Dir.'/'.$_SESSION['USER_ID'];
$_SESSION['USER_AVATAR'] = $Num;
mysqli_query($CONNECT, "UPDATE `users` SET `avatar` = $Num WHERE `id` = $_SESSION[USER_ID]");
break;
}
}
}
else $Download = 'resource/avatar/'.$_SESSION['USER_AVATAR'].'/'.$_SESSION['USER_ID'];

imagejpeg($Tmp, $Download.'.jpg');
imagedestroy($Image);
imagedestroy($Tmp);
}


MessageSend(3, 'Ваши новые данные сохранены');

}





ULogin(0);

//обработка ссылки
if ($Module == 'restore' and $Param['code'] and $_SESSION['ACCOUNT_DATA']['type'] == 'restore') {
	
if (MIX($_SESSION['ACCOUNT_DATA']['secret']) != $Param['code'])
	MessageSend(1, 'Восстановление невозможно.');
	$Random = RandomString(15);
	$Password = GenPass($Random, $_SESSION['ACCOUNT_DATA']['login']);
	
mysqli_query($CONNECT, 'UPDATE `users` SET `password` = "'.$Password.'" WHERE `login` = "'.$_SESSION['ACCOUNT_DATA']['login'].'"');
unset($_SESSION['ACCOUNT_DATA']); //удаляем нашу сессию
	MessageSend(2, 'Пароль успешно изменен, для входа используйте новый пароль <b>'.$Random.'</b>', '/login');
}


//обработка формы
if ($Module == 'restore' and $_POST['enter']) {
	checkLogin($_POST['login']);
	checkCaptcha($_POST['captcha']);

if ($_SESSION['captcha'] != md5($_POST['captcha'])) 
	MessageSend(1, 'Неверная капча!');

$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `email` FROM `users` WHERE `login` = '$_POST[login]'"));
if (!$Row['email'])	
	MessageSend(1, 'Пользователь не найден!');
	
	$_SESSION['ACCOUNT_DATA'] = array('type' => 'restore', 'login' => $_POST['login'], 'secret' => RandomString(20));

mail($Row['email'], 'ColdHarbour.ru', 'Ссылка для восстановления пароля: http://coldharbour.esy.es/account/restore/code/'.MIX($_SESSION['ACCOUNT_DATA']['secret']), 'From: coldharbour.ru');
	MessageSend(2, 'На ваш E-mail адрес <b>'.HideEmail($Row['email']).'</b> отправлено подтверждение смены пароля');
}
	



if ($Module == 'register' and $_POST['enter']) {	

checkCaptcha($_POST['captcha']);
if ($_SESSION['captcha'] != md5($_POST['captcha'])) MessageSend(1, 'Капча введена неверно');

checkLogin($_POST['login']);
checkPassword($_POST['password']);
checkEmail($_POST['email']);
checkName($_POST['name']);
checkRace($_POST['race']);
checkProvince($_POST['province']);

$_POST['password'] = GenPass($_POST['password'], $_POST['login']);

if (!$_POST['login'] or !$_POST['email'] or !$_POST['password'] or !$_POST['name'] or !$_POST['race'] > 11 or !$_POST['province'] > 9 or !$_POST['captcha']) MessageSend(1, 'Невозможно обработать форму.');
if ($_SESSION['captcha'] != md5($_POST['captcha'])) MessageSend(1, 'Неверная капча!');

CheckRegInfo($_POST['login'], $_POST['email']);

$_SESSION['ACCOUNT_DATA'] = array('type' => 'register', 'login' => $_POST['login'], 'password' => $_POST['password'], 'name' => $_POST['name'], 'email' =>  $_POST['email'], 'race' => $_POST['race'], 'province' => $_POST['province'], 'secret' => RandomString(20)); //сохраняем в сессию то, что человек ввел при регистрации

mail($_POST['email'], 'Регистрация на сайте', 'Ссылка для активации: http://coldharbour.esy.es/account/activate/code/'.MIX($_SESSION['ACCOUNT_DATA']['secret']), "From: coldharbour.ru\r\nMime: 1.0\r\nContent-type: text/plain; charset=UTF-8\r\n");
MessageSend(3, 'Регистрация аккаунта успешно завершена, на указанный E-mail адрес <b>'.$_POST['email'].'</b> отправлено письмо для подтверждения.');
}



else if ($Module == 'activate' and $Param['code'] and $_SESSION['ACCOUNT_DATA']['type'] == 'register') {

if (MIX($_SESSION['ACCOUNT_DATA']['secret']) != $Param['code'])
	MessageSend(1, 'Активация невозможна');

CheckRegInfo($_SESSION['ACCOUNT_DATA']['login'], $_SESSION['ACCOUNT_DATA']['password']); //проверяем по логину и паролю, чтобы два пользователя с одинаковыми логинами не зарегались за один час.
mysqli_query($CONNECT, 'INSERT INTO `users`  VALUES ("", "'.$_SESSION['ACCOUNT_DATA']['login'].'", "'.$_SESSION['ACCOUNT_DATA']['password'].'", "'.$_SESSION['ACCOUNT_DATA']['name'].'", NOW(), "'.$_SESSION['ACCOUNT_DATA']['email'].'", "'.$_SESSION['ACCOUNT_DATA']['race'].'", "'.$_SESSION['ACCOUNT_DATA']['province'].'", 0, 0, 0)');
unset($_SESSION['ACCOUNT_DATA']); //удаляем нашу сессию
	MessageSend(3, 'Аккаунт подтвержден.', '/login');
}




else if ($Module == 'login' and $_POST['enter']) {

if ($_SESSION['captcha'] != md5($_POST['captcha'])) MessageSend(1, 'Неверная капча!');
checkCaptcha($_POST['captcha']);

checkLogin($_POST['login']);
checkPassword($_POST['password']);

$_POST['password'] = GenPass($_POST['password'], $_POST['login']);

$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `password` FROM `users` WHERE `login` = '$_POST[login]'"));
if ($Row['password'] != $_POST['password']) MessageSend(1, 'Неверный логин или пароль.');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `name`, `regdate`, `email`, `race`, `province`, `avatar`, `password`, `login`, `group` FROM `users` WHERE `login` = '$_POST[login]'"));
$_SESSION['USER_LOGIN_IN'] = 1;

foreach ($Row as $Key => $Value) //записываем все значения из базы Row в сессии, и их значения, будет так: $_SESSION['USER_LOGIN'] = $Row['login'], и т.д.
	$_SESSION['USER_'.strtoupper($Key)] = $Value; //где strtoupper - переводит буквы в верхний регистр
	$_SESSION['USER_RACE'] = UserRace($_SESSION['USER_RACE']);
	$_SESSION['USER_PROVINCE'] = UserProvince($_SESSION['USER_PROVINCE']);
	
if ($_REQUEST['remember']) setcookie('user', $_POST['password'], strtotime('+30 days'), '/');
Location('/profile');
}


?>