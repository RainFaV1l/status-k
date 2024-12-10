<?php

namespace Modules\Auth\Enums;

enum UserRoleEnum: int
{
    case ADMIN = 1;
    case OPERATOR = 2;
    case USER = 3;

    public function getLabel(): string
    {
        return match ($this) {
            self::ADMIN => 'Администратор',
            self::OPERATOR => 'Оператор',
            self::USER => 'Пользователь'
        };
    }
}

