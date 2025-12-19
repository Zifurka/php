<?php
declare(strict_types=1);

/*
ЗАДАНИЕ 1
- Проверьте, была ли корректно отправлена форма
- Если она была отправлена, отфильтруйте полученные значения
- В зависимости от оператора производите различные математические действия
- В случае деления, проверьте делитель на равенство с нулём (на ноль делить нельзя)
- Сохраните полученный результат вычисления в переменной
*/

$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Фильтрация и валидация входных данных
    $num1 = filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_FLOAT);
    $num2 = filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_FLOAT);
    $operator = filter_input(INPUT_POST, 'operator', FILTER_SANITIZE_SPECIAL_CHARS);

    // Проверка корректности чисел
    if ($num1 === false || $num2 === false) {
        $error = 'Пожалуйста, введите корректные числа.';
    } elseif (!in_array($operator, ['+', '-', '*', '/'], true)) {
        $error = 'Недопустимый оператор.';
    } else {
        // Выполнение операции
        switch ($operator) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '/':
                if ($num2 == 0) {
                    $error = 'Деление на ноль невозможно!';
                } else {
                    $result = $num1 / $num2;
                }
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Калькулятор</title>
</head>
<body>

<!--<h1>Калькулятор</h1>-->

<?php
/*
ЗАДАНИЕ 2
- Если результат существует, выведите его
*/
if ($error) {
    echo "<p style='color: red;'>Ошибка: {$error}</p>";
} elseif ($result !== null) {
    echo "<p>Результат: <strong>{$result}</strong></p>";
}
?>
<form action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>" method="post">
<!--<form action="index.php?id=calc" method="post">-->
<!--<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">-->

<p><label for="num1">Число 1</label><br>
<input type="text" name="num1" id="num1" value="<?php echo isset($_POST['num1']) ? htmlspecialchars($_POST['num1']) : ''; ?>" required></p>

<p><label for="operator">Оператор</label><br>
<select name="operator" id="operator">
    <option value="+"<?php echo (isset($_POST['operator']) && $_POST['operator'] === '+') ? ' selected' : ''; ?>>+</option>
    <option value="-"<?php echo (isset($_POST['operator']) && $_POST['operator'] === '-') ? ' selected' : ''; ?>>-</option>
    <option value="*"<?php echo (isset($_POST['operator']) && $_POST['operator'] === '*') ? ' selected' : ''; ?>>*</option>
    <option value="/"<?php echo (isset($_POST['operator']) && $_POST['operator'] === '/') ? ' selected' : ''; ?>>/</option>
</select></p>

<p><label for="num2">Число 2</label><br>
<input type="text" name="num2" id="num2" value="<?php echo isset($_POST['num2']) ? htmlspecialchars($_POST['num2']) : ''; ?>" required></p>

<button type="submit">Считать!</button>

</form>

</body>
</html>
