<?php

declare(strict_types=1);

use DeviTools\Http\File\Download;
use DeviTools\Http\File\Upload;
use DeviTools\Http\Routing\Router;

Router::get('/{any}', Download::class)->where('any', '.*');
Router::post('/{any}', Upload::class)->where('any', '.*');
