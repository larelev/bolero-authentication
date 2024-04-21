<?php

use Bolero\Framework\Routing\Route;
use Bolero\Plugins\Authentication\Controllers\LoginController;
use Bolero\Plugins\Authentication\Controllers\RegistrationController;
use Bolero\Plugins\Authentication\Middlewares\Authentication;
use Bolero\Plugins\Authentication\Middlewares\Guest;

Route::get('/register', [RegistrationController::class, 'index',
    [
        Guest::class,
    ]]);
Route::post('/register', [RegistrationController::class, 'register']);
Route::get('/login', [LoginController::class, 'index',
    [
        Guest::class,
    ],
]);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout',
    [
        Authentication::class,
    ],
]);
