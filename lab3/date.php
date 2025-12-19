<?php
declare(strict_types=1);

// ЗАДАНИЕ 1
$now = time();
$birthday = strtotime('2004-12-22'); // Ваш день рождения

$dateInfo = getdate($now);
$hour = (int)$dateInfo['hours']; // явное приведение на всякий случай

// ЗАДАНИЕ 2: Приветствие
if ($hour >= 0 && $hour < 6) {
    $welcome = 'Доброй ночи';
} elseif ($hour >= 6 && $hour < 12) {
    $welcome = 'Доброе утро';
} elseif ($hour >= 12 && $hour < 18) {
    $welcome = 'Добрый день';
} elseif ($hour >= 18 && $hour <= 23) {
    $welcome = 'Добрый вечер';
} else {
    $welcome = 'Доброй ночи';
}

echo "<p>$welcome</p>\n";

// Русские названия дней недели и месяцев (для date())
$days = ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'];
$months = [
    '', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
    'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'
];

// Получаем компоненты даты через date()
$dayOfWeek = $days[(int)date('w', $now)]; // 0 = воскресенье
$day = (int)date('j', $now);
$month = (int)date('n', $now);
$year = (int)date('Y', $now);
$hours = (int)date('G', $now);
$minutes = (int)date('i', $now);
$seconds = (int)date('s', $now);

// Преобразуем числа в строки с ведущими нулями (обязательно как строки!)
$hoursStr = str_pad((string)$hours, 2, '0', STR_PAD_LEFT);
$minutesStr = str_pad((string)$minutes, 2, '0', STR_PAD_LEFT);
$secondsStr = str_pad((string)$seconds, 2, '0', STR_PAD_LEFT);

echo "<p>Сегодня {$day} {$months[$month]} {$year} года, {$dayOfWeek} {$hoursStr}:{$minutesStr}:{$secondsStr}</p>\n";

// Расчёт времени до дня рождения
$nowDate = new DateTime();
$birthThisYear = new DateTime("{$nowDate->format('Y')}-12-22"); // подставьте ваш ММ-ДД

if ($birthThisYear < $nowDate) {
    $birthThisYear->modify('+1 year');
}

$interval = $nowDate->diff($birthThisYear);

echo "<p>До моего дня рождения осталось</p>\n";
echo "<p>{$interval->days} дней, {$interval->h} часов, {$interval->i} минут и {$interval->s} секунд</p>\n";
?>