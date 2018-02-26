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

//Выборка из ссылки название файла с тестом
$linc = $_SERVER['REQUEST_URI'];
$numberSim = strpos($linc, '?');
$nameTest = substr ($linc, $numberSim+1);

if($nameTest == 'u/obulychev/php/lesson-6/test.php'){
	echo 'Выберите тест: <a href="./list.php">СПИСОК ТЕСТОВ</a>';
	exit;
}

//Подключение файла с тестом
$json_file = file_get_contents('./test/'.$nameTest);
$data = json_decode($json_file, true);

//Формирование формы с содержимым теста
echo "<form method='post'>";
$x = 1;

	foreach($data as $key => $value){
		echo "<br>Урок сложения: Сколько будет ".$key."? <input type='text' name='sum".$x++."' size='3' required><br>";
	}
	
	echo "<br><input type='submit' value='Проверить'>";
echo "</form>";


//Вывод ответа
if($_POST){
	$sum1 = $_POST['sum1'];
	$sum2 = $_POST['sum2'];
	$sum3 = $_POST['sum3'];
	
	$x = '1';	
		
	foreach($data as $key => $value){
			if($value == $_POST['sum'.$x]){
				echo "<br><span style='color:green;'>Правильно будет: ".$value."; Вы ввели: ".$_POST['sum'.$x]."</span><br>";
				$x++;
			}else{
				echo "<br><span style='color:red;'>Правильно будет: ".$value."; Вы ввели: ".$_POST['sum'.$x]."</span><br>";
			$x++;
			}
	}
}

?>


</body>
</html>