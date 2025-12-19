<?php
declare(strict_types=1);

function drawTable(int $cols = 10, int $rows = 10, string $color = 'yellow'): int
{
    static $count = 0;
    $count++;

    echo "<table>";
    for ($i = 0; $i <= $rows; $i++) {
        echo "<tr>";
        for ($j = 0; $j <= $cols; $j++) {
            if ($i === 0 && $j === 0) {
                echo "<th></th>";
            } elseif ($i === 0) {
                echo "<th style='background-color: {$color}; font-weight: bold; text-align: center;'>{$j}</th>";
            } elseif ($j === 0) {
                echo "<th style='background-color: {$color}; font-weight: bold; text-align: center;'>{$i}</th>";
            } else {
                echo "<td style='text-align: center;'>" . ($i * $j) . "</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";

    return $count;
}



function getMenu(array $menu, bool $vertical = true): void
{
    $class = $vertical ? 'menu' : 'menu horizontal';
    echo "<ul class=\"{$class}\">";
    foreach ($menu as $item) {
        echo "<li><a href='" . htmlspecialchars($item['href']) . "'>" . htmlspecialchars($item['link']) . "</a></li>";
    }
    echo "</ul>";
}

?>