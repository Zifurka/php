<?php

declare(strict_types=1);

header('Content-Type: text/html; charset=utf-8');

use MyProject\Classes\User;
use MyProject\Classes\SuperUser;

/**
 * Точка входа для демонстрации работы классов User и SuperUser.
 * Регистрирует автозагрузчик, создаёт экземпляры пользователей
 * и выводит информацию о них.
 */

/**
 * Автоматическая загрузка классов по пространству имён.
 * Преобразует полное имя класса (например, MyProject\Classes\User)
 * в путь к файлу (MyProject/Classes/User.php) и подключает его.
 * @param string $className Полное имя класса с пространством имён.
 * @return void
 */
spl_autoload_register(function (string $className): void {
    $filePath = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
    if (file_exists($filePath)) {
        require_once $filePath;
    }
});

// Создание экземпляров пользователей
$user1 = new User('Анна', 'anna123', 'secret1');
$user2 = new User('Борис', 'boris456', 'secret2');
$user3 = new User('Виктор', 'viktor789', 'secret3');
$superUser = new SuperUser('Админ', 'admin01', 'adminpass', 'Администратор');

// Вывод информации
$user1->showInfo();
$user2->showInfo();
$user3->showInfo();
$superUser->showInfo();
