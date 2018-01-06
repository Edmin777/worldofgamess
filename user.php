<?php 

if ($Module) {
$Module = FormChars($Module);
$Info = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `name`, `email`, `race`, `province`, `regdate`, `avatar`, `group`  FROM `users` WHERE `login` = '$Module'"));
if (!$Info['id']) MessageSend(1, 'Пользователь не найден.', '/user');

if (!$Info['avatar'])
$Avatar = 0;
else $Avatar = "$Info[avatar]/$Info[id]";

$User_profile = '
<div class="block">
<img src="/resource/avatar/'.$Avatar.'.jpg" width="120" height="120" alt="Аватар" align="left">
	<div class="userInfo">
		ID: '.$Info['id'].' Группа: ('.UserGroup($Info['group']).')
		<br>Имя: '.$Info['name'].'
		<br>Дата регистрации: '.$Info['regdate'].'
		<br>Email: '.HideEmail($Info['email']).'
		<br>Раса: '.UserRace($Info['race']).'
		<br>Провинция: '.UserProvince($Info['province']).'
	</div>
</div>
<a href="/" class="button profileB">Написать</a><br>';
} else {
	$Query = mysqli_query($CONNECT, 'SELECT `login`, `name` FROM `users` ORDER BY `id` DESC LIMIT 10');

while ($Row = mysqli_fetch_assoc($Query)) 
	$User_profile .= "<br>Логин: $Row[login] [ имя: $Row[name] ]";
}

Head('Профиль пользователя');
?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow();
?>
<div class="Page">
<?php echo $User_profile ?>
</div>
</div>
<?php Footer() ?>
</div>
</body>
</html> 