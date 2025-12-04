<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Цикл for</title>
</head>
<body>
	<h1>Цикл for</h1>
	<?php
	declare(strict_types=1);
	
	function printOddNumbers(int $start, int $end): void
	{
		for ($i = $start; $i <= $end; $i++) {
			if ($i % 2 !== 0) {
				echo $i . "<br>";
			}
		}
	}
	
	printOddNumbers(1, 50);
	?> 
</body>
</html>