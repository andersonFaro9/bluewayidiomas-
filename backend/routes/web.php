<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Routing\Router;

Router::get('/', function () {
    return file_get_contents(__DIR__ . '/../public/index.html');
});

Router::prefix('integration')->group(function () {
    Router::group([], __DIR__ . '/api/integration.php');
});

Router::prefix('checkout')->group(function () {
    Router::group([], __DIR__ . '/api/checkout.php');
});

Router::group(['prefix' => '/statics'], __DIR__ . '/web/statics.php');
Router::group(['prefix' => '/report'], __DIR__ . '/web/report.php');
