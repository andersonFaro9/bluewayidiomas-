<?php

use App\Http\Controllers\Api\Gateway\ShopController;
use App\Http\Controllers\Api\Gateway\TransactionController;
use App\Http\Routing\Router;

Router::restricted()->group(function () {
    Router::api('/gateway/shop', ShopController::class);
    Router::api('/gateway/transaction', TransactionController::class);
});
