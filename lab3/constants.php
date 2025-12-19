<?php
declare(strict_types=1);

// Получаем все определённые константы
$allConstants = get_defined_constants(true);

// Выводим в виде HTML-страницы
echo "<!DOCTYPE html>\n<html lang=\"ru\">\n<head>\n";
echo "<meta charset=\"UTF-8\">\n<title>Все константы PHP</title>\n";
echo "<style>body { font-family: monospace; font-size: 14px; }</style>\n</head>\n<body>\n";

foreach ($allConstants as $category => $constants) {
    echo "<h2>Категория: " . htmlspecialchars($category) . "</h2>\n";
    echo "<pre>\n";
    foreach ($constants as $name => $value) {
        // Преобразуем значение в строку для отображения
        if (is_bool($value)) {
            $strValue = $value ? 'true' : 'false';
        } elseif (is_null($value)) {
            $strValue = 'null';
        } elseif (is_string($value)) {
            $strValue = '"' . addslashes($value) . '"';
        } else {
            $strValue = (string)$value;
        }
        echo htmlspecialchars($name) . " = " . htmlspecialchars($strValue) . "\n";
    }
    echo "</pre>\n";
}

echo "</body>\n</html>";
?>
