<?php 
ULogin(1);
if ($_SESSION['USER_GROUP'] == 2)
$Active = 1;
else $Active = 0;

if ($_POST['enter'] and $_POST['text'] and $_POST['name'] and $_POST['cat'] and $_POST['autor']) {
if ($_FILES['img']['type'] != 'image/jpeg') 
MessageSend(2, 'Неверный тип изображения');
$_POST['name'] = FormChars($_POST['name']);
$_POST['autor'] = FormChars($_POST['autor']);
$_POST['cat'] +=0;

$MaxId = mysqli_fetch_row(mysqli_query($CONNECT, 'SELECT max(`id`) FROM `publ_skyrim`'));
if ($MaxId[0] == 0) mysqli_query($CONNECT, 'ALTER TABLE `publ_skyrim` AUTO_INCREMENT = 1');
$MaxId[0] += 1;

foreach(glob('catalog/img_skyrim_publ/*', GLOB_ONLYDIR) as $Num => $Dir) {
$Num_img++;
$Count = sizeof(glob($Dir.'/*.*'));
if ($Count < 250) {
move_uploaded_file($_FILES['img']['tmp_name'], $Dir.'/'.$MaxId[0].'.jpeg');
break;
}
}


MiniIMG('catalog/img_skyrim_publ/'.$Num_img.'/'.$MaxId[0].'.jpeg', 'catalog/mini_skyrim_publ/'.$Num_img.'/'.$MaxId[0].'.jpeg', 220, 220);

mysqli_query($CONNECT, "INSERT INTO `publ_skyrim` VALUES ($MaxId[0], '$_POST[name]', '$_POST[autor]', $_POST[cat], 0, '$_SESSION[USER_LOGIN]', '$_POST[text]', '$_POST[description]', NOW(), $Active, $Num_img, 0, '')");
MessageSend(2, 'Файл успешно добавлен!', '/publ_skyrim');
}
Head('Добавить материал'); 
?>
<body>
<div class="wrapper">
<div id="content">
<?php menuAndLogo();
MessageShow(); Left(); ?>
<div id="Page">
<form method="POST" action="/publ_skyrim/add" enctype="multipart/form-data">
	<h2>Добавить статью</h2>
	<br>
	<br>
	<input type="text" name="name" placeholder="Название статьи" required>
	<br>
	<br>
	<input type="text" name="autor" placeholder="Автор" required>
	<br>
	<br>
	<h3>Выберите категорию:</h3>
	<br>
	<select class="dropdown" size="1" name="cat">
		<option value="1">Броня и одежда</option>
		<option value="2">Категория 2</option>
		<option value="3">Категория 3</option>
		</select>
		<br>
	<br>
	<h3>Краткое описание</h3>
	<br><textarea name="description" id="editor1" class="desc" cols="100" rows="20" required></textarea>
	<script type="text/javascript">
		CKEDITOR.replace( 'editor1' );
</script>
	<br>
	<br>
	<h3>Полное описание</h3>
	<br><textarea name="text" class="add_load" id="editor2" required></textarea>
		<script type="text/javascript">
		CKEDITOR.replace( 'editor2' );
</script>
	<br>
	<br>
	<h3>Загрузите изображение:</h3>
	<br><input type="file" name="img" required> (Изображение)
	<br><br><br>
	<input type="submit" name="enter" value="Добавить" class="button medium cyan glow"> <input type="reset" value="Очистить" class="button medium cyan glow">
</form>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="/resource/js/jquery.easydropdown.js" type="text/javascript"></script>
</div>

<?php Footer(); ?>
</div>
</div>
</body>
</html>