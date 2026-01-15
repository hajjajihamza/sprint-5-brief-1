<?php

declare(strict_types=1);

namespace Core\Controller;

use Core\Http\Redirect;
use Core\Http\Response;
use JetBrains\PhpStorm\NoReturn;
use RuntimeException;

abstract class AbstractController
{
    protected function renderView(string $path, array $data = []): string
    {
        $templatePath = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);

        if (!str_ends_with($templatePath, '.php')) {
            $templatePath .= '.php';
        }

        if (!file_exists($templatePath)) {
            throw new RuntimeException("Template file not found: {$templatePath}");
        }

        extract($data);

        ob_start();
        require $templatePath;
        return ob_get_clean();
    }

    protected function render(string $path, array $data = []): Response
    {
        return new Response($this->renderView($path, $data));
    }

    #[NoReturn]
    protected function redirectToPath(string $path): void
    {
        Redirect::to($path);
    }
}