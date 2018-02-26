<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Домашнее задание</title>
</head>	
<body>

<?php

// Подключаем стили + меню
include './styleAndMenu.php';

?>

<?php

//Выводим из папки test список содержимых файлов
$dir    = './test';
$files = scandir($dir);
unset($files[0]);
unset($files[1]);

foreach($files as $key=>$value){	
	
	$json_file = file_get_contents('./test/'.$value);
	$data = json_decode($json_file, true);
				
		echo "<br><a href='./test.php?".$value."'>".$value."</a>";
		
}

?>


</body>
</html>