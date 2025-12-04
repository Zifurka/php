<?php
declare(strict_types=1);
$leftMenu = [
    ['link' => 'Домой', 'href' => 'index.php'],
    ['link' => 'О нас', 'href' => 'about.php'],
    ['link' => 'Контакты', 'href' => 'contact.php'],
    ['link' => 'Таблица умножения', 'href' => 'table.php'],
    ['link' => 'Калькулятор', 'href' => 'calc.php']
];
function getMenu(array $menu, bool $vertical = true): void
{
    $class = $vertical ? 'menu' : 'menu horizontal';
    echo "<ul class='{$class}'>";
    
    foreach ($menu as $item) {
        $href = htmlspecialchars($item['href']);
        $link = htmlspecialchars($item['link']);
        echo "<li><a href='{$href}'>{$link}</a></li>";
    }
    
    echo '</ul>';
}
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

		.horizontal {
			width: auto;
			background-color: #f1f1f1;
		}

		.horizontal li {
			display: inline;
			padding: 5px;
		}
	</style>
</head>
<body>
	<h1>Меню</h1>
	<h2>Вертикальное меню:</h2>
	<?php
	getMenu($leftMenu);
	?>
	<h2>Горизонтальное меню:</h2>
	<?php
	getMenu($leftMenu, false);
	?>
</body>
</html>