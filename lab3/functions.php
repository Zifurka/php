<?php
declare(strict_types=1);

// Получаем список всех загруженных расширений
$extensions = get_loaded_extensions();

$totalFunctions = 0;
// Начало HTML-документа
echo "<!DOCTYPE html>\n<html lang=\"ru\">\n<head>\n";
echo "<meta charset=\"UTF-8\">\n<title>Функции загруженных модулей PHP</title>\n";
echo "<style>body { font-family: monospace; font-size: 14px; line-height: 1.4; }</style>\n</head>\n<body>\n";

echo "<h1>Функции загруженных модулей PHP</h1>\n";

foreach ($extensions as $ext) {
    echo "<h2>Модуль: " . htmlspecialchars($ext) . "</h2>\n";
    
    $funcs = get_extension_funcs($ext);
    
    if ($funcs === false) {
        echo "<p>Нет функций или модуль не предоставляет информацию.</p>\n";
    } else {
         $count = count($funcs);
        $totalFunctions += $count;
        echo "<p>Всего функций: {$count}</p>\n";
        echo "<ul>\n";
        foreach ($funcs as $func) {
            echo "<li>" . htmlspecialchars($func) . "</li>\n";
        }
        echo "</ul>\n";
    }
}

echo "<hr>\n";
echo "<p><strong>Общее количество функций: {$totalFunctions}</strong></p>\n";
echo "</body>\n</html>";

?>
