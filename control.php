<?php 
UAccess(2);

if ($Param['id'] and $Param['command']) {
if ($Param['command'] == 'delete') {
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `dimg` FROM `publ_skyrim` WHERE `id` = $Param[id]"));
mysqli_query($CONNECT, "DELETE FROM `publ_skyrim` WHERE `id` = $Param[id]");
mysqli_query($CONNECT, "DELETE FROM `comments` WHERE `material` = $Param[id] AND `module` = 3");
unlink('catalog/img_skyrim_publ/'.$Row['dimg'].'/'.$Param['id'].'.jpeg');
unlink('catalog/mini_skyrim_publ/'.$Row['dimg'].'/'.$Param['id'].'.jpeg');

MessageSend(3, 'Материал удален!', '/publ_skyrim');
} else if 
($Param['command'] == 'active') {
mysqli_query($CONNECT, "UPDATE `publ_skyrim` SET `active` = 1 WHERE `id` = $Param[id]");
MessageSend(3, 'Материал активирован!', '/publ_skyrim/material/id/'.$Param['id']);
}
}
?>