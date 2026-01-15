<?php

namespace App\Middleware;
use Core\Http\Middleware;
use Core\Http\Redirect;
use Core\Http\Request;
use Core\Http\Response;
use Closure;

class AdminMiddleware extends Middleware
{
    /**
     * @inheritDoc
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()) {
            Redirect::to('/login');
        }

        return $next($request);
    }
}