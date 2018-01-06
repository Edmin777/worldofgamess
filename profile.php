<?php 
ULogin(1);
HeadProfile('Профиль пользователя');
?>
<body>
<div class="wrapper">
<div id="content">
<?php menuAndLogo();
MessageShow(); Left1(); ?>
<div id="Page">


<?php
if ($_SESSION['USER_AVATAR'] == 0)
$Avatar = 0;
else $Avatar = $_SESSION['USER_AVATAR'].'/'.$_SESSION['USER_ID'];

echo '
<div class="row">
<div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
<div class="well profile">
<div class="col-sm-12">
<div class="col-xs-12 col-sm-8">
<h2>'.$_SESSION['USER_LOGIN'].'</h2>
<p><strong><i class="fa fa-users" aria-hidden="true"></i>
Группа: </strong> '.UserGroup($_SESSION['USER_GROUP']).' </p>
<p><strong><i class="fa fa-user" aria-hidden="true"></i> Имя: </strong> '.$_SESSION['USER_NAME'].' </p>
<p><strong><i class="fa fa-clock-o" aria-hidden="true"></i>
Дата регистрации: </strong> '.$_SESSION['USER_REGDATE'].' </p>
<p><strong><i class="fa fa-envelope" aria-hidden="true"></i>
E-mail: </strong> '.$_SESSION['USER_EMAIL'].' </p>
<p><strong><i class="fa fa-reddit" aria-hidden="true"></i>
Раса: </strong>
<span class="tags">'.$_SESSION['USER_RACE'].'</span>
<p><strong><i class="fa fa-compass" aria-hidden="true"></i>
Провинция: </strong>
<span class="tags">'.$_SESSION['USER_PROVINCE'].'</span>
</p>
</div>
<div class="col-xs-12 col-sm-4 text-center">
<figure>
<img src="resource/avatar/'.$Avatar.'.jpg" width="120" height="120" alt="avatar" class="img-circle img-responsive">
<figcaption class="ratings">
<p><a href="/account/logout" class="button medium cyan glow"><span>Выход</span></a></p>
</figcaption>
</figure>
</div>
</div>
<div class="col-xs-12 divider text-center">
<div class="col-xs-12 col-sm-4 emphasis">
<h2><strong> 10 </strong></h2>
<p><small>Модов</small></p>
<a href="/pm/dialog" class="button medium cyan glow"><span>Сообщения</span></a>
</div>
<div class="col-xs-12 col-sm-4 emphasis">
<h2><strong>15</strong></h2>
<p><small>Комментариев</small></p>
<a href="/notice" class="button medium cyan glow"><span>Уведомления</span></a>
</div>
<div class="col-xs-12 col-sm-4 emphasis">
<h2><strong>22</strong></h2>
<p><small>Публикаций</small></p>
<div class="btn-group dropup btn-block">
<a href="#" class="button medium cyan glow"><span>Посмотреть</span></a>
</div>
</div>
</div>
</div>
<div class="profileEdit">
<h2>Изменить личные данные</h2>
<br>
	<form method="POST" action="/account/edit" enctype="multipart/form-data">
		<input type="password" name="opassword" placeholder="Пароль" maxlength="15" pattern="[A-Za-z-0-9]{5,15}" title="не менее 5 и не более 15 латинских символов или цифр">
		<input type="password" name="npassword" placeholder="Новый пароль" maxlength="15" pattern="[A-Za-z-0-9]{5,15}" title="не менее 5 и не более 15 латинских символов или цифр">
		<br><input type="text" name="name" placeholder="Имя" pattern="[А-яА-яЁё]{3,15}" title="не менее 3 и не более 15 русских букв" value="'.$_SESSION['USER_NAME'].'" required>
		<br><select class="dropdown" size="1" name="race">'.str_replace('>'.$_SESSION['USER_RACE'], 'selected>'.$_SESSION['USER_RACE'], '<option value="1">Альтмер</option>
			<option value="2">Аргонианин</option>
			<option value="3">Босмер</option>
			<option value="4">Бретонец</option>
			<option value="5">Данмер</option>
			<option value="6">Имперец</option>
			<option value="7">Каджит</option>
			<option value="8">Норд</option>
			<option value="9">Орк</option>
			<option value="10">Редгард</option>').'</select>
			
			<br><select class="dropdown" size="1" name="province">'.str_replace('>'.$_SESSION['USER_PROVINCE'], 'selected>'.$_SESSION['USER_PROVINCE'], '<option value="1">Скайрим</option>
			<option value="2">Морроувинд</option>
			<option value="3">Сиродиил</option>
			<option value="4">Хай Рок</option>
			<option value="5">Эльсвейр</option>
			<option value="6">Хаммерфелл</option>
			<option value="7">Валенвуд</option>
			<option value="8">Чернотопье</option>
			<option value="9">Саммерсет</option>').'</select>
			
		<br><input type="file" name="avatar">
		<br>
		<br><input type="submit" name="enter" value="Сохранить" class="button medium cyan glow">
	</form>
</div>
</div>
</div>
';



?>



	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="/resource/js/jquery.easydropdown.js" type="text/javascript"></script>
</div>
<?php Footer() ?>
</div>
</div>
</body>
</html> 