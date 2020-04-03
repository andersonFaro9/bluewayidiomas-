<?php
/**
 *
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Sentry\State\Scope;
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
            configureScope(function (Scope $scope): void {
                $scope->setUser([
                    'id' => auth()->user()->id,
                    'email' => auth()->user()->email,
                ]);
            });
        }
        configureScope(function (Scope $scope): void {
            $payload = json_decode(file_get_contents('php://input'), true);
            if (!is_array($payload)) {
                $payload = [];
            }
            $reduce = function ($accumulator, $value, $key) {
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