<?php

use App\Http\Controllers\Api\Admin\ActionController;
use App\Http\Controllers\Api\Admin\ProfileController;
use App\Http\Controllers\Api\Admin\User\Destroy;
use App\Http\Controllers\Api\Admin\User\Password;
use App\Http\Controllers\Api\Admin\User\UserEmail;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Auth\Me;
use App\Http\Routing\Router;

Router::restricted()->group(function () {
    Router::post('/admin/user/management/password', Password::class);
    Router::post('/admin/user/management/destroy', Destroy::class);
    Router::get('/admin/user/me', Me::class);
    Router::get('/admin/user/email/{email}', UserEmail::class);

    Router::api('/admin/user', UserController::class);
    Router::api('/admin/profile', ProfileController::class);
    Router::api('/admin/action', ActionController::class);
});
