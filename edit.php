<?php 
UAccess(1);
$Param['id'] += 0;
if (!$Param['id']) 
MessageSend(1, 'Не указан ID материала', '/publ_skyrim');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `cat`, `name`, `autor`, `text`, `dimg`, `description` FROM `publ_skyrim` WHERE `id` = $Param[id]"));
if (!$Row['name']) 
MessageSend(1, 'Материал не найден!', '/publ_skyrim/');

if ($_POST['enter'] and $_POST['text'] and $_POST['name'] and $_POST['cat']) {
$_POST['name'] = FormChars($_POST['name']);
$_POST['autor'] = FormChars($_POST['autor']);
$_POST['cat'] +=0;

if ($_FILES['img']['tmp_name'])
move_uploaded_file($_FILES['img']['tmp_name'], 'catalog/img_skyrim_publ/'.$Row['dimg'].'/'.$Param['id'].'.jpeg');

mysqli_query($CONNECT, "UPDATE `publ_skyrim` SET `name` = '$_POST[name]', `cat` = $_POST[cat], `description` = '$_POST[description]', `text` = '$_POST[text]'  WHERE `id` = $Param[id]");
MessageSend(2, 'Материал успешно отредактирован!', '/publ_skyrim/material/id/'.$Param['id']);
}

Head('Редактировать материал'); 
?>
<body>
<div class="wrapper">
<div id="content">
<?php menuAndLogo();
MessageShow(); Left1(); ?>
<div id="Page">
<?php
echo '<form method="POST" action="/publ_skyrim/edit/id/'.$Param['id'].'" enctype="multipart/form-data">
	<h2>Изменить материал</h2>
	<br>
	<input type="text" name="name" placeholder="Название статьи" value="'.$Row['name'].'" required>
	<br>
	<br>
	<h3>Изменить категорию:</h3>
	<br><select size="1" class="dropdown" name="cat">'.str_replace('value="'.$Row['cat'], 'selected value="'.$Row['cat'], '<option value="1">Прохождение</option>
		<option value="2">Секреты и баги</option>').'</select> 
	<br>
	<br>
	<h3>Краткое описание</h3>
	<br><textarea name="description" id="editor1" class="desc" required>'.str_replace('<br>', '', $Row['description']).'</textarea>
	<br>
	<br>
	<h3>Полное описание</h3>
	<br><textarea name="text" class="add_load" id="editor2" required>'.str_replace('<br>', '', $Row['text']).'</textarea>
	<br>
	<br>
	<h3>Загрузите изображение:</h3>
	<br><input type="file" name="img"> (Изображение)
	<br><br><br><input type="submit" name="enter" value="Сохранить" class="button medium cyan glow"> <input type="reset" value="Очистить" class="button medium cyan glow">
</form>'
?>
	<script type="text/javascript">
		CKEDITOR.replace('editor1');
	</script>
	
	<script type="text/javascript">
		CKEDITOR.replace('editor2');
	</script>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="/resource/js/jquery.easydropdown.js" type="text/javascript"></script>
</div>

<?php Footer(); ?>
</div>
</div>
</body>
</html>