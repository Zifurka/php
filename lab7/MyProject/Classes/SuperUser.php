<?php

declare(strict_types=1);

namespace MyProject\Classes;

/**
 * Представляет суперпользователя (администратора) системы.
 * Наследуется от класса User и расширяет его ролью.
 */
class SuperUser extends User
{
    /**
     * Роль суперпользователя 
     * @var string
     */
    public string $role;

    /**
     * Инициализирует новый экземпляр суперпользователя.
     * Передаёт параметры родительскому конструктору и устанавливает роль.
     * @param string $name Имя пользователя.
     * @param string $login Уникальный логин.
     * @param string $password Пароль пользователя.
     * @param string $role Роль суперпользователя.
     */
    public function __construct(string $name, string $login, string $password, string $role)
    {
        parent::__construct($name, $login, $password);
        $this->role = $role;
    }

    /**
     * Выводит расширенную информацию о суперпользователе.
     * Отображает имя, логин и роль в HTML-формате.
     * @return void
     */
    public function showInfo(): void
    {
        echo "Имя: {$this->name}, Логин: {$this->login}, Роль: {$this->role}<br>";
    }
}
