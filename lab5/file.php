<?php
/*
ЗАДАНИЕ 1
- Установите константу для хранения имени файла
- Проверьте, отправлялась ли форма и корректно ли отправлены данные из формы
- В случае, если форма была отправлена, отфильтруйте полученные значения 
  с помощью функций trim(), strip_tags(), htmlspecialchars()
- Сформируйте строку для записи с файл
- Откройте соединение с файлом и запишите в него сформированную строку
- Используя функцию header() выполните перезапрос текущей страницы 
  (чтобы избавиться от данных, отправленных методом POST)
*/

define('DATA_FILE', __DIR__ . '/guestbook.txt');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'] ?? '';
    $lname = $_POST['lname'] ?? '';

    // Фильтрация и очистка
    $fname = trim(strip_tags(htmlspecialchars($fname, ENT_QUOTES, 'UTF-8')));
    $lname = trim(strip_tags(htmlspecialchars($lname, ENT_QUOTES, 'UTF-8')));

    if ($fname !== '' && $lname !== '') {
        $entry = date('Y-m-d H:i:s') . " | {$fname} {$lname}" . PHP_EOL;

        // Убедимся, что папка db существует
        $dir = dirname(DATA_FILE);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
          // Запись в файл с блокировкой
        file_put_contents(DATA_FILE, $entry, FILE_APPEND | LOCK_EX);
    }

    // Перенаправление для предотвращения повторной отправки
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Работа с файлами</title>
</head>
<body>

<h1>Заполните форму</h1>

<form method="post" action="<?=$_SERVER['PHP_SELF']?>" 
      onsubmit="return validateForm()">

  Имя: <input type="text" name="fname" id="fname"><br>
  Фамилия: <input type="text" name="lname" id="lname"><br>
  <br>
  <input type="submit" value="Отправить!">

</form>
<script>
function validateForm() {
    const fname = document.getElementById('fname').value.trim();
    const lname = document.getElementById('lname').value.trim();

    if (fname === '' || lname === '') {
        alert('Пожалуйста, заполните оба поля: Имя и Фамилия.');
        return false; // отменяет отправку формы
    }
    return true; // разрешает отправку
}
</script>
<?php
/*
ЗАДАНИЕ 2
- Проверьте, существует ли файл с информацией о пользователях
- Если файл существует, получите все содержимое файла в виде массива строк 
  с помощью функции file()
- В цикле выведите все строки данного файла с порядковым номером строки
- После этого выведите размер файла в байтах.
*/


if (file_exists(DATA_FILE)) {
    $lines = file(DATA_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (!empty($lines)) {
        echo "<h2>Список записей:</h2>\n<ol>\n";
        foreach ($lines as $line) {
            echo "<li>" . htmlspecialchars($line, ENT_QUOTES, 'UTF-8') . "</li>\n";
        }
        echo "</ol>\n";
    }

    $fileSize = filesize(DATA_FILE);
    echo "<p><strong>Размер файла:</strong> {$fileSize} байт</p>\n";
} else {
    echo "<p>Файл с записями ещё не создан.</p>\n";
}

?>

</body>
</html>



