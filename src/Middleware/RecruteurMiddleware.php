<?php

namespace App\Middleware;
use Core\Http\Middleware;
use Core\Http\Redirect;
use Core\Http\Request;
use Core\Http\Response;
use Closure;
use Core\Utils\ViewUtil;

class RecruteurMiddleware extends Middleware
{
    /**
     * @inheritDoc
     */
    public function handle(Request $request, Closure $next): Response
    {
        //  not authorized user
        if (!$request->user()?->getRole()->isRecruteur()) {
            return new Response(ViewUtil::renderView('errors/403'), 403);
        }

        return $next($request);
    }
}