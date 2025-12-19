<?php
declare(strict_types=1);

/*
ЗАДАНИЕ 1
- Инициализируйте переменную для подсчета количества посещений
- Если соответствующие данные передавались через куки — сохраняйте их в эту переменную 
- Нарастите счетчик посещений
- Инициализируйте переменную для хранения значения последнего посещения страницы
- Если соответствующие данные передавались из куки, отфильтруйте их и сохраните в эту переменную.
  Для фильтрации используйте функции trim(), htmlspecialchars()
- С помощью функции setcookie() установите соответствующие куки. Задайте время хранения куки 1 сутки. 
  Для задания времени последнего посещения страницы используйте функцию date()
*/

// Инициализация счётчика посещений
$visits = 1;
if (isset($_COOKIE['visits']) && is_numeric($_COOKIE['visits'])) {
    $visits = (int)$_COOKIE['visits'] + 1;
}

// Инициализация даты последнего посещения
$lastVisit = '';
if (isset($_COOKIE['last_visit'])) {
    // Фильтрация согласно заданию: trim() + htmlspecialchars()
    $lastVisit = htmlspecialchars(trim($_COOKIE['last_visit']));
}

// Устанавливаем куки на 1 сутки (86400 секунд)
$expire = time() + 86400;
setcookie('visits', (string)$visits, $expire, '/');
setcookie('last_visit', date('d-m-Y H:i:s'), $expire, '/');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Последний визит</title>
</head>
<body>

<h1>Последний визит</h1>

<?php
/*
ЗАДАНИЕ 2
- Выводите информацию о количестве посещений и дате последнего посещения
*/
if ($visits === 1) {
    echo "<p>Добро пожаловать!</p>";
} else {
    echo "<p>Вы зашли на страницу {$visits} раз.</p>";
    echo "<p>Последнее посещение: {$lastVisit}</p>";
}
?>

</body>
</html>
