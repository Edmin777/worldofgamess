<?php 
if (!in_array($Module, array('news', 'loads', 'publ_skyrim', 'publ_oblivion', 'publ_morrowind', 'skyrim', 'oblivion', 'morrowind', 'lore_tes'))) MessageSend(1, 'Модуль не найден.', '/');


if ($_POST['enter']) {
$_SESSION['SEARCH'] = FormChars($_POST['text']);
exit(header('location: /search/'.$Module));
}

if (!$_SESSION['SEARCH']) MessageSend(1, 'Слово для поиска не указано.', '/');
Head('Результаты поиска');
?>
<body>
<div class="wrapper">
<div id="content">
	<?php menuAndLogo(); 
MessageShow(); Left(); ?>
<div id="Page">

<?php  
$Count = mysqli_fetch_row(mysqli_query($CONNECT, "SELECT COUNT(`id`) FROM `$Module` WHERE `name` LIKE '%$_SESSION[SEARCH]%'"));


if ($Count[0]) {
if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, "SELECT `id`, `name`, `date`, `dimg`, `description` FROM `$Module` WHERE `name` LIKE '%$_SESSION[SEARCH]%' ORDER BY `id` DESC LIMIT 0, 5");
} else {
$Start = ($Param['page'] - 1) * 5;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, "SELECT `id`, `name`, `date`, `dimg`, `description`  FROM `$Module` WHERE `name` LIKE '%$_SESSION[SEARCH]%' ORDER BY `id` DESC LIMIT START, 5"));
}

PageSelector("/search/$Module/page/", $Param['page'], $Count);
while ($Row = mysqli_fetch_assoc($Result)) echo '
<div id="note"><span><i class="fa fa-calendar" aria-hidden="true"></i> Добавлен: '.$Row['date'].'</span><br><hr><br><h2><a href="/'.$Module.'/material/id/'.$Row['id'].'" class="aTitle">'.$Row['name'].'</a></h2><br><a href="/catalog/img_skyrim/'.$Row['dimg'].'/'.$Row['id'].'.jpeg" data-fancybox data-caption="'.$Row['name'].'"><img src="/catalog/img_skyrim/'.$Row['dimg'].'/'.$Row['id'].'.jpeg" class="img_main" style="max-width: 250px; max-height: 250px;" alt="'.$Row['name'].'"/></a><div class="p"><h2 align="center">Описание</h2><br><p class="description">'.$Row['description'].'</p></div><div id="search_podr"><a href="/skyrim/material/id/'.$Row['id'].'" class="button medium cyan glow" align="right"><span>Подробнее</span></a></div></div>
';
} else echo 'По вашему запросу ничего не найдено.';
?>
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="/resource/js/jquery.fancybox.min.js"></script>
</div>

<?php Footer() ?>
</div>
</div>
</body>
</html> 