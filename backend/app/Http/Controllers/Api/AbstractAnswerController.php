<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Response\AnswerTrait;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
abstract class AbstractAnswerController extends Controller
{
    /**
     * @see AnswerTrait
     */
    use AnswerTrait;
}
