<?php 
Head('Восстановить пароль'); 
ULogin(0);
?>
<body>
<div class="wrapper">
<div id="content">
<?php menuAndLogo();
MessageShow(); Left(); ?>
<div id="Page">
<form method="POST" action="/account/restore">
	<h2>Восстановление пароля</h2>
	<br>
	<br><input type="text" name="login" placeholder="Логин" maxlength="15" pattern="[A-Za-z-0-9]{2,15}" title="не менее 3 и не более 15 латинских символов или цифр" required>
	<br><br><div class="capdiv"><input type="text" class="capinp" name="captcha" placeholder="Капча" pattern="[0-9]{1,6}" title="только цифры" required><br><br><img src="resource/captcha.php" alt="капча" class="capimg"></div>
	<br><br><br><input type="submit" name="enter" value="Восстановить" class="button medium cyan glow"> <input type="reset" value="Очистить" class="button medium cyan glow">
</form>

</div>

<?php Footer() ?>
</div>
</div>
</body>
</html> 