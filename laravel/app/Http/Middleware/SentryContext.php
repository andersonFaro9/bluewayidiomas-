<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Sentry\State\Scope;

use function is_array;
use function PhpBrasil\Collection\pack;
use function Sentry\configureScope;

/**
 * Class SentryContext
 * @package App\Http\Middleware
 */
class SentryContext
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && app()->bound('sentry')) {
            configureScope(static function (Scope $scope): void {
                $scope->setUser([
                    'id' => auth()->user()->id,
                    'email' => auth()->user()->email,
                ]);
            });
        }
        configureScope(static function (Scope $scope): void {
            /** @noinspection JsonEncodingApiUsageInspection */
            $payload = json_decode(file_get_contents('php://input'), true);
            if (!is_array($payload)) {
                $payload = [];
            }
            $reduce = static function ($accumulator, $value, $key) {
                $accumulator[] = [$key => $value];
                return $accumulator;
            };
            $scope->setExtra('POST', pack($_POST)->reduce($reduce, []));
            $scope->setExtra('GET', pack($_GET)->reduce($reduce, []));
            $scope->setExtra('PAYLOAD', pack($payload)->reduce($reduce, []));
        });

        return $next($request);
    }
}