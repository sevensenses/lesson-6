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

<form method="post" enctype="multipart/form-data" name="myform">
	<input name="userfile" type="file">
	<input type="submit" value="Отправить файлы ">
</form>

<?php

if(isset($_FILES['userfile'])){	
	$json_file = file_get_contents($_FILES['userfile']['tmp_name']);
	$data = json_decode($json_file, true);
	
	foreach($data as $dataKey=>$dataValue){
		if((gettype($dataKey) == "string") and (gettype($dataValue) == "integer")){
			
			$file = $_FILES['userfile'];
			$nameFile = $file['name'];
			$file = $_FILES['userfile'];
			
			//Ищем ПОСЛЕДНЕЕ вхождение точки в названии файла, не путать с функцией strpos - которая ищет первое
			$searchTerms = strrpos($nameFile, '.');
			//Вырезаем все что после точки - а именно: формат файл
			$sampleFormat = substr($nameFile, $searchTerms);
			
			$dir    = './test';
			$files = scandir($dir);
			
			//Смотрим есть ли такой файл
			if(!(array_search($nameFile, $files))){
				//Если нету, и при этом его расширение .json - заносим
				if($sampleFormat == ".json"){
				move_uploaded_file($file['tmp_name'], './test/'.$nameFile);
					
					//После отправки, смотрим, есть ли он в директории
					$arrayDir = scandir('./test/');
					$result = array_search($nameFile, $arrayDir);
						
						if($result){
							echo "<span style='color:green;'>Передан!</span>";
						}else{
							echo "<span style='color:red;'>Что то пошло не так!</span>";
						}
				
				}else{
					echo "<span style='color:red;'>Формат должен быть .json</span>";
				}
			//Если есть, сообщаем об этом
			}else{
				echo "<span style='color:red;'>Такйо файл уже ЕСТЬ</span>";
			}	
			
			break;	
			
		}else{
			echo "<span style='color:red;'>Структура файла не корректна.</span>";
			break;
		}			
	}
}
?>

</body>
</html>