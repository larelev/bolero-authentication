<?php

use Bolero\Framework\Routing\Route;

Route::get('/register', [\Bolero\Plugins\Authentication\Controllers\RegistrationController::class, 'index',
    [
        \Bolero\Plugins\Authentication\Middlewares\Guest::class,
    ]]);
Route::post('/register', [\Bolero\Plugins\Authentication\Controllers\RegistrationController::class, 'register']);
Route::get('/login', [\Bolero\Plugins\Authentication\Controllers\LoginController::class, 'index',
    [
        \Bolero\Plugins\Authentication\Middlewares\Guest::class,
    ],
]);
Route::post('/login', [\Bolero\Plugins\Authentication\Controllers\LoginController::class, 'login']);
Route::get('/logout', [\Bolero\Plugins\Authentication\Controllers\LoginController::class, 'logout',
    [
        \Bolero\Plugins\Authentication\Middlewares\Authentication::class,
    ],
]);
