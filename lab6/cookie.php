<?php
// Проверяем, есть ли уже информация о куках в URL
$cookieCheck = isset($_GET['cookie_status']) ? $_GET['cookie_status'] : null;

if ($cookieCheck === null && !isset($_COOKIE['visit_count'])) {
    // Пытаемся поставить тестовую куку
    setcookie('test_cookie', '1', time() + 3600, '/');
    // Перезагружаем страницу, чтобы проверить, пришла ли она обратно
    $url = strtok($_SERVER["REQUEST_URI"], '?');
    header("Location: " . $url . "?cookie_status=checking");
    exit;
}

// Определяем, работают ли куки
$cookiesEnabled = isset($_COOKIE['test_cookie']) || isset($_COOKIE['visit_count']);

$currentDateTime = date('d-m-Y H:i:s');

if ($cookiesEnabled) {
    $visitCount = isset($_COOKIE['visit_count']) ? (int)$_COOKIE['visit_count'] + 1 : 1;
    $lastVisit = isset($_COOKIE['last_visit']) ? $_COOKIE['last_visit'] : '';
    
    setcookie('visit_count', $visitCount, strtotime('+1 day'), '/');
    setcookie('last_visit', $currentDateTime, strtotime('+1 day'), '/');
} else {
    // КУКИ ВЫКЛЮЧЕНЫ — РАБОТАЕМ ЧЕРЕЗ ФАЙЛЫ (FINGERPRINT)
    $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
    $storageFile = __DIR__ . "/data_" . $fingerprint . ".txt";

    if (file_exists($storageFile)) {
        $fileData = explode('|', file_get_contents($storageFile));
        $visitCount = (int)$fileData[0] + 1;
        $lastVisit = $fileData[1];
    } else {
        $visitCount = 1;
        $lastVisit = '';
    }
    file_put_contents($storageFile, $visitCount . '|' . $currentDateTime);
}
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
    if ($visitCount == 1) {
        echo 'Добро пожаловать!';
    } else {
        echo 'Вы зашли на страницу ' . $visitCount . ' раз' . '<br>';
        echo 'Последнее посещение: ' . $lastVisit;
    }
    ?>
</body>
</html>