<?php

namespace Bolero\Plugins\Authentication;

class Authentication
{
    public const AUTH_KEY = 'auth_id';

    public static function viewsPaths(): array
    {
        return [
            __DIR__ . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR,
        ];
    }

    public static function routes(): void
    {
        include __DIR__ . DIRECTORY_SEPARATOR . 'Routes' . DIRECTORY_SEPARATOR . 'Web.php';
    }
}
