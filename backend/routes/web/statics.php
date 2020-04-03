<?php

use App\Http\Controllers\File\Download;
use App\Http\Controllers\File\Upload;
use App\Http\Routing\Router;

Router::get('/{any}', Download::class)->where('any', '.*');
Router::post('/{any}', Upload::class)->where('any', '.*');
