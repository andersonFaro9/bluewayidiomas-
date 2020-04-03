<?php

use App\Http\Controllers\Report\ReportLoading;
use App\Http\Controllers\Report\ReportProcess;
use App\Http\Routing\Router;

Router::get('/loading', ReportLoading::class);
Router::get('/process/{report}', ReportProcess::class);
Router::post('/process/{report}', ReportProcess::class)->middleware(['jwt.auth']);