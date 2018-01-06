<?php 
Head('Вход'); 
ULogin(0);
?>
<body>
<div class="wrapper">
	<div id="content">
<?php menuAndLogo();
MessageShow(); Left(); ?>
<div id="Page">
<form method="POST" action="/account/login">
	<h2>Вход</h2>
	<br>
	<input type="text" name="login" placeholder="Логин" maxlength="15" title="не менее 3 и не более 15 латинских символов или цифр" required>
	<br>
	<br><input type="password" name="password" placeholder="Пароль" maxlength="15" pattern="[A-Za-z-0-9]{5,15}" title="не менее 5 и не более 15 латинских символов или цифр" required>
	<br>
	<br><div class="capdiv"><input type="text" class="capinp" name="captcha" placeholder="Капча" pattern="[0-9]{1,6}" title="только цифры" required><br><br><img src="/resource/captcha.php" alt="капча" class="capimg"></div>
	<br>
	<br>
	<br>
	<br><input type="checkbox" name="remember" id="check1">
	<label for="check1"><span></span>Запомнить меня</label>
	<br><br><input type="submit" name="enter" value="Вход" class="button medium cyan glow"> <input type="reset" value="Очистить" class="button medium cyan glow">
</form>

<iframe id="otpwt17008" src="//onlinetestpad.com/wt/39e6583fccda40d5830085382b32c4a2" frameborder="0" style="width:80%;" onload="var f = document.getElementById('otpwt17008'); var h = 0; var listener = function (event) { h = parseInt(event.data); if (isNaN(h)) h = 400; f.style.height = h + 'px'; }; function addEvent(elem, evnt, func) { if (elem.addEventListener) { elem.addEventListener(evnt, func, false); } else if (elem.attachEvent) { elem.attachEvent('on' + evnt, func); } else { elem['on' + evnt] = func; } }; addEvent(window, 'message', listener);" scrolling="no" ></iframe>

</div>
<?php Footer() ?>
</div>
</div>
</body>
</html> 