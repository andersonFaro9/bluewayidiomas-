<?php

namespace App\Exceptions;

use App\Http\Response\AnswerTrait;
use App\Http\Status;
use Exception;
use ForceUTF8\Encoding;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * Class Handler
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    /**
     * @see AnswerTrait
     */
    use AnswerTrait;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception $exception
     * @return JsonResponse|IlluminateResponse|SymfonyResponse
     */
    public function render($request, Exception $exception)
    {
        $route = $request->route();
        if (!$route || in_array('api', $route->middleware(), true)) {
            $request->headers->set('Accept', 'application/json');
        }

        if ($exception instanceof ErrorGeneral) {
            return $this->answerWith($exception);
        }

        if ($exception instanceof UnauthorizedHttpException) {
            $message = 'Unauthorized';
            $data = [];
            if ($exception->getMessage() === 'Token has expired') {
                $data['token'] = 'expired';
            }
            return $this->answerError($message, Status::CODE_401, $data);
        }

        if ($exception instanceof QueryException) {
            $bindings = $exception->getBindings();
            if (!is_array($bindings)) {
                $bindings = [$bindings];
            }
            foreach ($bindings as $key => $binding) {
                $bindings[$key] = Encoding::fixUTF8($binding);
            }
            $message = Encoding::fixUTF8($exception->getMessage());
            $data = [
                'sql' => $exception->getSql(),
                'bindings' => $bindings,
            ];
            return $this->answerError($message, Status::CODE_500, $data);
        }

        return parent::render($request, $exception);
    }

    /**
     * @param ErrorGeneral $exception
     * @return JsonResponse
     */
    protected function answerWith(ErrorGeneral $exception)
    {
        $code = $exception->getStatusCode();
        $meta = ['errors' => $exception->getDetails()];

        if ($code >= 400 && $code < 500) {
            return $this->answerFail(null, $meta, $code);
        }

        $message = $exception->getMessage();
        $debug = '';
        if (env('APP_DEBUG')) {
            $debug = utf8_encode($exception->getTraceAsString());
        }
        return $this->answerError($message, $code, $meta, false, $debug);
    }
}
