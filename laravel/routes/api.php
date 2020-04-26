<?php

declare(strict_types=1);

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

use DeviTools\Http\Response\Answer;
use DeviTools\Http\Routing\Router;

Router::prefix('v1')->group(static function () {
    Router::group([], __DIR__ . '/api/auth.php');
    Router::group([], __DIR__ . '/api/admin.php');
    Router::group([], __DIR__ . '/api/academic.php');
});

if (env('APP_DEV')) {
    Router::get('/unauthorized', static function () {
        return response('unauthorized', 401);
    });
}

$action = static function () {
    return Answer::error('Route not found', 404);
};
Router::match(['GET', 'POST', 'DELETE'], '{any}', $action)->where('any', '.*');
