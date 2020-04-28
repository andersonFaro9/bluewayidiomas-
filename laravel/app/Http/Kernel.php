<?php

namespace App\Http;

use App\Http\Middleware\SentryContext;
use Artesaos\Defender\Middlewares\NeedsPermissionMiddleware;
use Artesaos\Defender\Middlewares\NeedsRoleMiddleware;
use Barryvdh\Cors\HandleCors;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Tymon\JWTAuth\Http\Middleware\Authenticate as JWTAuthenticate;
use Tymon\JWTAuth\Http\Middleware\RefreshToken as JWTRefreshToken;

use function PhpBrasil\Collection\Helper\prop;

/**
 * Class Kernel
 * @package App\Http
 */
class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        Middleware\CheckForMaintenanceMode::class,
        ValidatePostSize::class,
        Middleware\TrimStrings::class,
        ConvertEmptyStringsToNull::class,
        Middleware\TrustProxies::class,
        HandleCors::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            Middleware\EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            ShareErrorsFromSession::class,
            // Middleware\VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
            SentryContext::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'bindings' => SubstituteBindings::class,
        'cache.headers' => SetCacheHeaders::class,
        'can' => Authorize::class,
        'signed' => ValidateSignature::class,
        'throttle' => ThrottleRequests::class,
        'json' => Middleware\JsonContent::class,
        'guest' => Middleware\RedirectIfAuthenticated::class,
        'jwt.auth' => JWTAuthenticate::class,
        'jwt.refresh' => JWTRefreshToken::class,

        // Access control using permissions
        'needsPermission' => NeedsPermissionMiddleware::class,
        // Simpler access control, uses only the groups
        'needsRole' => NeedsRoleMiddleware::class
    ];

    /**
     * Bootstrap the application for HTTP requests.
     *
     * @return void
     */
    public function bootstrap()
    {
        parent::bootstrap();

        DB::beginTransaction();
    }

    /**
     * Call the terminate method on any terminable middleware.
     *
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function terminate($request, $response)
    {
        parent::terminate($request, $response);

        if (!DB::transactionLevel()) {
            return;
        }

        $force = false;
        if ($response instanceof JsonResponse) {
            $force = (boolean)prop($response->getData(), 'commit');
        }

        if ((!$force) && ($response->isClientError() || $response->isServerError())) {
            DB::rollBack();
            return;
        }
        DB::commit();
    }
}
