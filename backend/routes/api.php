<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Response\Answer;
use App\Http\Routing\Router;

Router::prefix('v1')->group(function () {
    Router::group([], __DIR__ . '/api/auth.php');
    Router::group([], __DIR__ . '/api/admin.php');
    Router::group([], __DIR__ . '/api/gateway.php');
});

if (env('APP_DEV')) {
    Router::get('/info', function () {
        /** @noinspection ForgottenDebugOutputInspection */
        echo phpinfo();
    });
    Router::get('/unauthorized', function () {
        return response('unauthorized', 401);
    });
}

$action = function () {
    return Answer::error('Route not found', 404);
};
Router::match(['GET', 'POST', 'DELETE'], '{any}', $action)->where('any', '.*');
