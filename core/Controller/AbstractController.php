<?php

declare(strict_types=1);

namespace Core\Controller;

use Core\Http\Redirect;
use Core\Http\Response;
use Core\Utils\ViewUtil;
use JetBrains\PhpStorm\NoReturn;
use RuntimeException;

abstract class AbstractController
{
    protected function render(string $path, array $data = []): Response
    {
        return new Response(ViewUtil::renderView($path, $data));
    }

    #[NoReturn]
    protected function redirectToPath(string $path): void
    {
        Redirect::to($path);
    }
}