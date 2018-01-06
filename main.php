<?php 
$Param['id'] += 0;
$Param['cat'] += 0;

if ($Param['cat'] and $Param['cat'] <= 0 or $Param['cat'] > 2)
	MessageSend(1, 'URL адрес указан неверно', '/publ_skyrim'); 
Head('ColdHarbour - Статьи по Skyrim, прохождение, читы, секреты'); 
?>
<body>
<div class="wrapper">
<div id="content">
<?php
MessageShow();
?>
<?php if ($_SESSION['USER_GROUP'] == 1 or $_SESSION['USER_GROUP'] == 2) 
	$Add .= '<div id="sky_add"><a href="/publ_skyrim/add" class="button medium cyan glow"><span>Добавить статью</span></a></div>' ?>
<?php menuAndLogo(); 
MessageShow(); LeftSkyrim(); ?>

<div id="Page">
<?php 
if ($Module == 'main' and !$Param['cat']) {
if ($_SESSION['USER_GROUP'] !=2) 
$Active = 'WHERE `active` = 1';
$Param1 = 'SELECT `id`, `name`, `autor`, `cat`, `read`, `added`, `text`, `description`, `date`, `active`, `dimg`, `rate` FROM `publ_skyrim` '.$Active.' ORDER BY `id` DESC LIMIT 0, 5';
$Param2 = 'SELECT `id`, `name`, `autor`, `cat`, `read`, `added`, `text`, `description`, `date`, `active`, `dimg`, `rate` FROM `publ_skyrim` '.$Active.' ORDER BY `id` DESC LIMIT START, 5';
$Param3 = 'SELECT COUNT(`id`) FROM `publ_skyrim`';
$Param4 = '/publ_skyrim/main/page/';
}
else {
if ($_SESSION['USER_GROUP'] !=2) 
$Active = 'AND `active` = 1';
$Param1 = 'SELECT `id`, `name`, `autor`, `cat`, `read`, `added`, `text`, `description`, `date`, `active`, `dimg`, `rate` FROM `publ_skyrim` WHERE `cat` = '.$Param['cat'].' '.$Active.' ORDER BY `id` DESC LIMIT 0, 5';
$Param2 = 'SELECT `id`, `name`, `autor`, `cat`, `read`, `added`, `text`, `description`, `date`, `active`, `dimg`, `rate` FROM `publ_skyrim` WHERE `cat` = '.$Param['cat'].' '.$Active.' ORDER BY `id` DESC LIMIT START, 5';
$Param3 = 'SELECT COUNT(`id`) FROM `publ_skyrim` WHERE `cat` = '.$Param['cat'];
$Param4 = '/publ_skyrim/main/cat/'.$Param['cat'].'/page/';
}

$Count = mysqli_fetch_row(mysqli_query($CONNECT, $Param3));

if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, $Param1);
} else {
$Start = ($Param['page'] - 1) * 5;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, $Param2));
}


PageSelector($Param4, $Param['page'], $Count);

Search(); echo $Add;

while ($Row = mysqli_fetch_assoc($Result)) {
if (!$Row['active']) 
$Row['name'] .= ' (Ожидает модерации)';
echo '<div id="note"><span> <i class="fa fa-user-o" aria-hidden="true"></i>  Добавил: '.$Row['added'].'  |  <i class="fa fa-copyright" aria-hidden="true"></i>
  Автор: '.$Row['autor'].' | <i class="fa fa-calendar" aria-hidden="true"></i> Дата добавления: '.$Row['date'].' | <i class="fa fa-bar-chart" aria-hidden="true"></i> Оценок: '.$Row['rate'].'</span><br><hr><br><h2><a href="/publ_skyrim/material/id/'.$Row['id'].'" class="aTitle">'.$Row['name'].'</a></h2><br><a href="/catalog/img_skyrim_publ/'.$Row['dimg'].'/'.$Row['id'].'.jpeg" data-fancybox data-caption="'.$Row['name'].'"><img src="/catalog/img_skyrim_publ/'.$Row['dimg'].'/'.$Row['id'].'.jpeg" class="img_main" style="max-width: 250px; max-height: 250px;" alt="'.$Row['name'].'"/></a>
  <div class="p">
  <div class="desc_material"><h3>Описание</h3></div>
  <br>
  <p class="description">'.$Row['description'].'</p>
  </div>
<br><br><hr><br><span><i class="fa fa-eye" aria-hidden="true"></i> Просмотров: '.$Row['read'].'</span><div id="podr"><a href="/publ_skyrim/material/id/'.$Row['id'].'" class="button medium cyan glow"><span>Подробнее</span></a></div></div>';
}
?>


</div>
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="/resource/js/jquery.fancybox.min.js"></script>
<?php Footer() ?>
</div>
</div>
</body>
</html> 