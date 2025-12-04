<?php
declare(strict_types=1);
$cols = 10;
$rows = 10;
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
			background-color: white;
		}

		th,
		td {
			padding: 10px;
			border: 1px solid black;
			text-align: center;
		}

		th {
			background-color: yellow;
		}
		
		.header-cell {
			font-weight: bold;
			background-color: #e6f7ff;
		}
	</style>
</head>
<body>
	<h1>Таблица умножения <?php echo $rows; ?> × <?php echo $cols; ?></h1>
	<table>
		<?php
		for ($i = 1; $i <= $rows; $i++): ?>
			<tr>
				<?php for ($j = 1; $j <= $cols; $j++): 
					$isHeader = ($i == 1 || $j == 1);
					$cellClass = $isHeader ? 'header-cell' : '';
					?>
					<td class="<?php echo $cellClass; ?>">
						<?php echo $i * $j; ?>
					</td>
				<?php endfor; ?>
			</tr>
		<?php endfor; ?>
	</table>
</body>
</html>