<?php 

function Parser($p1, $p2, $p3) { //p1 - строка, в которой просходит поиск нужной информации, p2 - уникальный элемент под номером 1, p3 - уникальный элемент под номером 2.
	$num1 = strpos($p1, $p2);
	if ($num1 === false)
		return 0;
	$num2 = substr($p1, $num1); //обрезает текст выше тэга нужного
	return strip_tags(substr($num2, 0, strpos($num2, $p3))); 
}
$String = file_get_contents('http://tes-game.ru/');
echo Parser($String, '<h2 title="За последний месяц" class="top5modsm">', '</h2>');
?>
