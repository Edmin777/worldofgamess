<?php 
ULogin(1);

if ($Module == 'delete' and $Param['id']) {
	$Param['id'] += 0;
	
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `uid` FROM `notice` WHERE `id` = $Param[id]"));
if (!$Row['uid'])
	MessageSend(1, 'Уведомление не найдено', '/notice');
else if ($Row['uid'] != $_SESSION['USER_ID'])
	MessageSend(1, 'Доступ запрещен', '/notice');

mysqli_query($CONNECT, "DELETE FROM `notice` WHERE `id` = $Param[id]");
	MessageSend(3, 'Уведомление удалено', '/notice');
}

mysqli_query($CONNECT, "UPDATE `notice` SET `status` = 1 WHERE `uid` = $_SESSION[USER_ID] AND `status` = 0"); //обновляем базу и устанавливаем статус прочитано, по данному пользователю и со статусом 0.

Head('Уведомления');
?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow();
?>
<div class="Page">


<?php

$Count = mysqli_fetch_row(mysqli_query($CONNECT, "SELECT COUNT(`id`) FROM `notice` WHERE `uid` = $_SESSION[USER_ID]")); //подсчитываем кол-во уведомлений по id пользователя

if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, "SELECT `id`, `status`, `date`, `text` FROM `notice` WHERE `uid` = $_SESSION[USER_ID] ORDER BY `id` DESC LIMIT 0, 5");
} else {
$Start = ($Param['page'] - 1) * 5;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, "SELECT `id`, `status`, `date`, `text` FROM `notice` WHERE `uid` = $_SESSION[USER_ID] ORDER BY `id` DESC LIMIT START, 5"));
}

if (!$Count[0])
	MessageSend(2, 'У вас нет уведомлений.', '/');

PageSelector('/notice/', $Module, $Count);


while ($Row = mysqli_fetch_assoc($Result)) {
	if ($Row['status'])
		$Status = 'Прочитано';
	else 
		$Status = 'Не прочитано';
echo '<a href="/notice/delete/id/'.$Row['id'].'"><div class="commentsBlock"><span>Статус: '.$Status.' | '.$Row['date'].'</span> '.$Row['text'].' </div></a>';
}

?>


</div>
</div>
<?php Footer() ?>
</div>
</body>
</html> 