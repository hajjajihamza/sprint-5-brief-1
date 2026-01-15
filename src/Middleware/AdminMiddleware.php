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
        //  not authorized user
        if (!$request->user()?->getRole()->isAdmin()) {
            return new Response('You are not authorized', 403);
        }

        return $next($request);
    }
}