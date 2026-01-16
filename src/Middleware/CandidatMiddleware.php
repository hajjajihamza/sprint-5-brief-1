<?php

namespace App\Middleware;
use Core\Http\Middleware;
use Core\Http\Redirect;
use Core\Http\Request;
use Core\Http\Response;
use Closure;
use Core\Utils\ViewUtil;

class CandidatMiddleware extends Middleware
{
    /**
     * @inheritDoc
     */
    public function handle(Request $request, Closure $next): Response
    {
        //  not authorized user
        if (!$request->user()?->getRole()->isCandidat()) {
            return new Response(ViewUtil::renderView('errors/403'), 403);
        }

        return $next($request);
    }
}