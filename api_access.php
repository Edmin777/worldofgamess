<?php 
Head('Тесты'); 
ULogin(1);
?>
<body>
<div class="wrapper">
	<div id="content">
<?php menuAndLogo();
MessageShow(); Left(); ?>
<div id="Page">



<iframe id="otpwt17008" src="//onlinetestpad.com/wt/39e6583fccda40d5830085382b32c4a2" frameborder="0" style="width:80%;" onload="var f = document.getElementById('otpwt17008'); var h = 0; var listener = function (event) { h = parseInt(event.data); if (isNaN(h)) h = 400; f.style.height = h + 'px'; }; function addEvent(elem, evnt, func) { if (elem.addEventListener) { elem.addEventListener(evnt, func, false); } else if (elem.attachEvent) { elem.attachEvent('on' + evnt, func); } else { elem['on' + evnt] = func; } }; addEvent(window, 'message', listener);" scrolling="no" ></iframe>

</div>
<?php Footer() ?>
</div>
</div>
</body>
</html> 