<?php

namespace App\Router;
use Closure;

class Route
{
    public function __construct(
        private string $path,
        private array | Closure $action
    ) {}

    public function getPath(): string
    {
        return $this->path;
    }

    public function getAction()
    {
        return $this->action;
    }
}