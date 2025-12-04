<?php
declare(strict_types=1);
$leftMenu = [
    ['link' => 'Домой', 'href' => 'index.php'],
    ['link' => 'О нас', 'href' => 'about.php'],
    ['link' => 'Контакты', 'href' => 'contact.php'],
    ['link' => 'Таблица умножения', 'href' => 'table.php'],
    ['link' => 'Калькулятор', 'href' => 'calc.php']
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Меню</title>
	<style>
		.menu {
			list-style-type: none;
			margin: 0;
			padding: 0;
			width: 200px;
			background-color: #f1f1f1;
		}

		.menu li a {
			display: block;
			color: #000;
			padding: 8px 16px;
			text-decoration: none;
		}

		.menu li a:hover {
			background-color: #555;
			color: white;
		}
	</style>
</head>
<body>
	<h1>Меню</h1>
	<nav>
	<?php
	echo '<ul class="menu">';
	foreach ($leftMenu as $item) {
		echo '<li><a href="' . htmlspecialchars($item['href']) . '">' . htmlspecialchars($item['link']) . '</a></li>';
	}
	echo '</ul>';
	?> 
	</nav>
</body>
</html>