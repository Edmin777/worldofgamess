<?php
ULogin(1);
if ($Module != 'news' and $Module != 'loads' and $Module != 'publ_skyrim' and $Module != 'publ_oblivion' and $Module != 'publ_morrowind' and $Module != 'skyrim' and $Module != 'oblivion' and $Module != 'morrowind' and $Module != 'lore_tes')
	MessageSend(1, 'Модуль указан неверно.', '/');
$Param['id'] += 0;

$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `rateusers` FROM `$Module` WHERE `id` = $Param[id]"));
	if (!isset($Row['rateusers']))
	MessageSend(1, 'Материал не найден.', '/');

if (in_array($_SESSION['USER_ID'], explode(',', $Row['rateusers']))) //in_array - производит поиск по массиву, что искать - идентификатор пользователя, разбиваем по айди с помощью explode, и если rateusers есть в таблице, то выводим ошибку.
	MessageSend(1, 'Вы уже оценивали данный материал.');
	
mysqli_query($CONNECT, "UPDATE `$Module` SET `rate` = `rate` + 1, `rateusers` = CONCAT(rateusers, ',$_SESSION[USER_ID]') WHERE `id` = $Param[id]"); //обновляем в базе модулей строчку с рейтингом +1, и дописываем с помощью CONCAT значение идентификатора пользователя, оценившего материал. где id = id материала.
	MessageSend(3, 'Материал оценен.');
?>