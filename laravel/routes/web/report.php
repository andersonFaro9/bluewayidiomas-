<?php

declare(strict_types=1);

use DeviTools\Http\Report\ReportLoading;
use DeviTools\Http\Report\ReportProcess;
use DeviTools\Http\Routing\Router;

Router::get('/loading', ReportLoading::class);
Router::get('/process/{report}', ReportProcess::class);
Router::post('/process/{report}', ReportProcess::class)->middleware(['jwt.auth']);