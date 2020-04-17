<?php

use App\Http\Controllers\Api\Auth\Activate;
use App\Http\Controllers\Api\Auth\Confirm;
use App\Http\Controllers\Api\Auth\Login;
use App\Http\Controllers\Api\Auth\Logout;
use App\Http\Controllers\Api\Auth\Me;
use App\Http\Controllers\Api\Auth\Refresh;
use App\Http\Controllers\Api\Auth\Register;
use App\Http\Controllers\Api\Auth\Remember;
use App\Http\Controllers\Api\Auth\Reset;
use App\Http\Controllers\Api\Auth\Session;
use App\Http\Controllers\Api\State;
use App\Http\Routing\Router;

Router::post('/auth/register', Register::class);
Router::post('/auth/confirm', Confirm::class);
Router::post('/auth/login', Login::class);
Router::post('/auth/logout', Logout::class);
Router::post('/auth/refresh', Refresh::class);
Router::post('/auth/remember', Remember::class);
Router::get('/auth/session/{session}', Session::class);
Router::get('/auth/activate/{code}', Activate::class);
Router::get('/auth/reset/{code}', Reset::class);
Router::get('/auth/state/{token}', State::class);

Router::restricted()->group(static function () {
    Router::get('/auth/me', Me::class);
});
