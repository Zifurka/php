<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Цикл while</title>
</head>
<body>
	<h1>Цикл while</h1>
	<?php
	declare(strict_types=1);
	
	function printStringVertically(string $text): void
	{
		$i = 0;
		while ($i < mb_strlen($text)) {
			echo mb_substr($text, $i, 1) . "<br>";
			$i++;
		}
	}
	
	$var = 'ПРИВЕТ';
	printStringVertically($var);
	?> 
</body>
</html>