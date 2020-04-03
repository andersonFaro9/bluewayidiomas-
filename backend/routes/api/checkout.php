<?php

use App\Http\Controllers\Checkout\Confirm;
use App\Http\Controllers\Checkout\Pay;
use App\Http\Controllers\Checkout\Status;
use App\Http\Controllers\Checkout\Success;
use App\Http\Routing\Router;

Router::get('/success', Success::class);
Router::post('/pay', Pay::class);
Router::get('/confirm/{id}', Confirm::class);
Router::get('/status/{id}', Status::class);
