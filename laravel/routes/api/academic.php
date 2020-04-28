<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Academic\GradeController;
use App\Http\Controllers\Api\Academic\ActivityController;
use App\Http\Controllers\Api\Academic\RegistrationController;
use DeviTools\Http\Routing\Router;

Router::restricted()->group(static function () {
    Router::api('/academic/grade', GradeController::class);
    Router::api('/academic/activity', ActivityController::class);
    Router::api('/academic/registration', RegistrationController::class);
});
