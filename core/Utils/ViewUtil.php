<?php

namespace Core\Utils;

use RuntimeException;

abstract class ViewUtil
{
    public static function renderView(string $path, array $data = []): string
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
}