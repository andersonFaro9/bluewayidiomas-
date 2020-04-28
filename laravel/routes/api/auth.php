<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth\Confirm;
use App\Http\Controllers\Api\Auth\Login;
use App\Http\Controllers\Api\Auth\Me;
use App\Http\Controllers\Api\Auth\Refresh;
use App\Http\Controllers\Api\Auth\Register;
use DeviTools\Http\Routing\Router;

Router::post('/auth/register', Register::class);
Router::post('/auth/confirm', Confirm::class);
Router::post('/auth/login', Login::class);
Router::post('/auth/refresh', Refresh::class);

Router::restricted()->group(static function () {
    Router::get('/auth/me', Me::class);
});
