<?php
include_once 'setting.php'
$CONNECT = mysqli_connect(HOST, USER, PASS, DB);

//очищаем таблицу с онлайном, каждые 10 минут в отдельную CRON задачу
mysqli_query($CONNECT, "DELETE FROM `online` WHERE `time` < SUBTIME(NOW(), '0 0:10:0')");
?>