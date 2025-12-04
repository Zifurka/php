<?php
declare(strict_types=1);
function getTable(int $cols = 10, int $rows = 10, string $color = '#e6f7ff'): int
{
    static $count = 0;
    $count++;
    
    echo "<h2>Таблица умножения {$rows} × {$cols}</h2>";
    echo "<table style='border: 2px solid black; border-collapse: collapse; margin-bottom: 20px;'>";
    
    for ($i = 1; $i <= $rows; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= $cols; $j++) {
            $isHeader = ($i == 1 || $j == 1);
            $style = $isHeader ? "style='font-weight: bold; text-align: center; background-color: {$color};'" : "style='text-align: center;'";
            echo "<td {$style}>{$i * $j}</td>";
        }
        echo "</tr>";
    }
    
    echo "</table>";
    
    return $count;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Таблица умножения</title>
	<style>
		table {
			border: 2px solid black;
			border-collapse: collapse;
		}

		th,
		td {
			padding: 10px;
			border: 1px solid black;
		}

		th {
			background-color: yellow;
		}
	</style>
</head>
<body> 
	<h1>Таблица умножения</h1>
	<?php
	$call1 = getTable(8, 6, '#ffcccc');
	$call2 = getTable(5, 7, '#ccffcc');
	$call3 = getTable(12, 12, '#ccccff');
	$call4 = getTable();
	$call5 = getTable(7);
	$call6 = getTable(6, 4);
	
	echo "<p>Функция getTable() была вызвана {$call6} раз(а)</p>";
	?> 
</body>
</html>