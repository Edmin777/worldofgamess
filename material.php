<?php 
$Param['id'] += 0;
if ($Param['id'] == 0) MessageSend(1, 'URL адрес указан неверно', '/publ_skyrim');

$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT `name`, `autor`, `added`, `date`, `read`, `text`, `active`, `dimg`, `rate`, `rateusers` FROM `publ_skyrim` WHERE `id` = '.$Param['id']));
if (!$Row['name']) MessageSend(1, 'Такого материала не существует!', '/publ_skyrim');

if (!$Row['active'] and $_SESSION['USER_GROUP'] !=2)
MessageSend(1, 'Материал ожидает модерации', '/publ_skyrim');

mysqli_query($CONNECT, 'UPDATE `publ_skyrim` SET `read` = `read` + 1 WHERE `id` = '.$Param['id']);
Head($Row['name']); 
?>
<body>
<div class="wrapper">
<div id="content">
<?php menuAndLogo();
MessageShow(); Left(); ?>
<div id="Page">
<?php

if ($Row['rateusers']) {
	$Exp = explode(',', $Row['rateusers']); //разбиваем по запятой наши айди голосовавших и записываем в переменную

foreach ($Exp as $value) {
if ($value) {
$Row2 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `id` = $value"));
$Rated .= '<a href="/user/'.$Row2['login'].'" class="edit">'.$Row2['login'].'</a><br> ';
}	
}

} else 
	$Rated = '-';

if (!$Row['active'])
$DoActive = '| <a href="/publ_skyrim/control/id/'.$Param['id'].'/command/active"><i class="fa fa-check" aria-hidden="true"></i>
 Активировать материал</a>';
if ($_SESSION['USER_GROUP'] == 1 or $_SESSION['USER_GROUP'] == 2)
$EDIT = '<hr><p class="description" align="center"><a href="/publ_skyrim/edit/id/'.$Param['id'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать материал</a> | <a href="/publ_skyrim/control/id/'.$Param['id'].'/command/delete"><i class="fa fa-times" aria-hidden="true"></i> Удалить материал</a>'.$DoActive.'</p>';

echo '<div class="title_material"><h3>'.$Row['name'].'</h3></div>
<hr>
<br>
<p class="description" align="center"><i class="fa fa-eye" aria-hidden="true"></i> Просмотров: '.($Row['read'] + 1).' | <i class="fa fa-user-o" aria-hidden="true"></i> Добавил: '.$Row['added'].' | <i class="fa fa-calendar" aria-hidden="true"></i> Дата: '.$Row['date'].'</p>
<hr>
<br><p class="description">'.$Row['text'].'</p>
<hr>
<p class="description"><i class="fa fa-copyright" aria-hidden="true"></i> Автор: '.$Row['autor'].' | <i class="fa fa-bar-chart" aria-hidden="true"></i> Оценок: '.$Row['rate'].''?> <a href="#0" class="butt_rait" onclick="show('block')">Кто оценил</a><?php echo '
<div id="podr_publ"><a href="/rating/publ_skyrim/id/'.$Param['id'].'" class="button medium cyan glow"><span>Мне нравится</span></a></p></div>
'.$EDIT.''
?>
<hr>
<br>
<div class="desc_material"><h3>Комментарии</h3></div>
<?php
include("module/comments/main.php");
?>

</div>

<script type="text/javascript">
			function show(state){

					document.getElementById('window_rating').style.display = state;			
					document.getElementById('wrap_rating').style.display = state; 			
			}
			
		</script>
		<!-- Задний прозрачный фон-->
		<div onclick="show('none')" id="wrap_rating"></div>

			<!-- Само окно-->
			<div id="window_rating">
				<br>
				<?php echo '<h3 align="center">Оценили:</h3> <br><br><p class="rating_users"><i class="fa fa-star" aria-hidden="true"></i> '.$Rated.'</p>'?>
				<br>
				
			</div>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="/resource/js/jquery.fancybox.min.js"></script>
<?php Footer() ?>
</div>
</div>
</body>
</html> 