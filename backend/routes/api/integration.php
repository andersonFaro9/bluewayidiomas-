<?php

use App\Http\Controllers\Integration\Transaction\TransactionApprove;
use App\Http\Controllers\Integration\Transaction\TransactionDecline;
use App\Http\Controllers\Integration\Transaction\TransactionRecover;
use App\Http\Routing\Router;

Router::get('/transaction/{id}', TransactionRecover::class);
Router::post('/transaction/{id}/approve', TransactionApprove::class);
Router::post('/transaction/{id}/decline', TransactionDecline::class);
