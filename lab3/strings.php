<?php
declare(strict_types=1);

$login = 'user';
$password = 'megaP@ssw0rd';
$name = 'иван';
$email = 'ivan@petrov.ru';
$code = '<?=$login?>';
	/*
	ЗАДАНИЕ 1
	- Создайте строковую переменную $login и присвойте ей значение ' User '
	- Создайте строковую переменную $password и присвойте ей значение 'megaP@ssw0rd'
	- Создайте строковую переменную $name и присвойте ей значение 'иван'
	- Создайте строковую переменную $email и присвойте ей значение 'ivan@petrov.ru'
	- Создайте строковую переменную $code и присвойте ей значение '<?=$login?>'
	*/
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Использование функций обработки строк</title>
</head>
<body>

<?php
	/*
	ЗАДАНИЕ 2
	- Используя строковые функции, удалите пробельные символы в начале и конце переменной $login, а также сделайте все символы строчными (малыми)
	- Проверьте значение переменной $password на сложность: пароль должен содержать минимум одну заглавную латинскую букву, одну строчную и одну цифру, а длина должна быть не меньше 8 символов. Оформите полученный код в виде пользовательской функции.
	- Используя строковые функции, сделайте первый символ значения переменной $name прописной (большой)
	- Используя функцию фильтрации переменных проверьте корректность значения $email
	- Используя строковые функции выведите значение переменной $code в браузер в том же виде как она задана в коде
	*/
	$login = trim(strtolower($login));
	
	echo "<p>Обработанный логин: <strong>$login</strong></p>";
	
	function isPasswordStrong(string $password): bool
{
    if (strlen($password) < 8) {
        return false;
    }
    $hasUpper = (bool) preg_match('/[A-Z]/', $password);
    $hasLower = (bool) preg_match('/[a-z]/', $password);
    $hasDigit = (bool) preg_match('/\d/', $password);
    return $hasUpper && $hasLower && $hasDigit;
}

echo "<p>Пароль " . (isPasswordStrong($password) ? 'надёжный' : 'ненадёжный') . "</p>";

$name = mb_convert_case($name, MB_CASE_TITLE, 'UTF-8');

echo "<p>Имя с заглавной буквы: <strong>$name</strong></p>";

$isEmailValid = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;

echo "<p>Email " . ($isEmailValid ? 'корректный' : 'некорректный') . "</p>";

echo htmlspecialchars($code, ENT_NOQUOTES, 'UTF-8');

?>
</body>
</html>