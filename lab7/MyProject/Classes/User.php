<?php

declare(strict_types=1);

namespace MyProject\Classes;

/**
 * Представляет обычного пользователя системы.
 * Хранит основные данные пользователя: имя, логин и пароль.
 * Пароль является приватным и недоступен извне.
 */
class User
{
    /**
     * Имя пользователя.
     * @var string
     */
    public string $name;

    /**
     * Уникальный логин пользователя.
     * @var string
     */
    public string $login;

    /**
     * Пароль пользователя (хранится приватно).
     * @var string
     */
    private string $password;

    /**
     * Инициализирует новый экземпляр пользователя.
     * @param string $name Имя пользователя.
     * @param string $login Уникальный логин.
     * @param string $password Пароль пользователя.
     */
    public function __construct(string $name, string $login, string $password)
    {
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * Выводит информацию о пользователе в HTML-формате.
     * Отображает имя и логин. Пароль не выводится.
     * @return void
     */
    public function showInfo(): void
    {
        echo "Имя: {$this->name}, Логин: {$this->login}<br>";
    }

    /**
     * Деструктор объекта пользователя.
     * Вызывается автоматически при уничтожении объекта.
     * Выводит сообщение об удалении с указанием логина.
     * @return void
     */
    public function __destruct()
    {
        echo "Пользователь {$this->login} удален.<br>";
    }
}
