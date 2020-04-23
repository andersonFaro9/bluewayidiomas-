<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Response\AnswerTrait;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
abstract class AbstractController extends Controller
{
    /**
     * @see AnswerTrait
     */
    use AnswerTrait;
}
