<?php 
Head('Регистрация'); 
ULogin(0);
?>
<body>
<div class="wrapper">
<div id="content">
<?php 
menuAndLogo(); 
MessageShow(); Left();?>
<div id="Page">
<?php MessageShow();?>
<form method="POST" action="/account/register">
	<h2>Регистрация</h2>
	<br><input type="text" name="login" placeholder="Логин" maxlength="15" pattern="[A-Za-z-0-9]{2,15}" title="не менее 3 и не более 15 латинских символов или цифр" required>
	<br>
	<br><input type="email" name="email" placeholder="E-Mail" required>
	<br>
	<br><input type="password" name="password" placeholder="Пароль" maxlength="15" pattern="[A-Za-z-0-9]{5,15}" title="не менее 5 и не более 15 латинских символов или цифр" required>
	<br>
	<br><input type="text" name="name" placeholder="Имя" pattern="[А-яА-яЁё]{3,15}" title="не менее 3 и не более 15 русских букв" required>
	
	<br>
	<br>
	<h3>Выберите расу:</h3>
	<br><select class="dropdown" size="1" name="race" required>
		<option value="1">Альтмер</option>
		<option value="2">Аргонианин</option>
		<option value="3">Босмер</option>
		<option value="4">Бретонец</option>
		<option value="5">Данмер</option>
		<option value="6">Имперец</option>
		<option value="7">Каджит</option>
		<option value="8">Норд</option>
		<option value="9">Орк</option>
		<option value="10">Редгард</option>
		</select>
	<br>
	<h3>Выберите провинцию:</h3>
	<br><select class="dropdown" size="1" name="province" required>
		<option value="1">Скайрим</option>
		<option value="2">Морроувинд</option>
		<option value="3">Сиродиил</option>
		<option value="4">Хай Рок</option>
		<option value="5">Эльсвейр</option>
		<option value="6">Хаммерфелл</option>
		<option value="7">Валенвуд</option>
		<option value="8">Чернотопье</option>
		<option value="9">Саммерсет</option>
		</select>
	<br>
	<div class="capdiv"><input type="text" class="capinp" name="captcha" placeholder="Капча" pattern="[0-9]{1,6}" title="только цифры" required><br><br><img src="resource/captcha.php" alt="капча" class="capimg"></div>
	<br>
	<br>
	<br><input type="submit" name="enter" value="Регистрация" class="button medium cyan glow"> <input type="reset" value="Очистить" class="button medium cyan glow">
</form>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="/resource/js/jquery.easydropdown.js" type="text/javascript"></script>
</div>

<?php Footer(); ?>
</div>
</div>
</body>
</html>