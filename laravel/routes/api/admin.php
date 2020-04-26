<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Admin\ActionController;
use App\Http\Controllers\Api\Admin\ProfileController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Auth\Me;
use DeviTools\Http\Routing\Router;

Router::restricted()->group(static function () {
    Router::get('/admin/user/me', Me::class);

    Router::api('/admin/user', UserController::class);
    Router::api('/admin/profile', ProfileController::class);
    Router::api('/admin/action', ActionController::class);
});
