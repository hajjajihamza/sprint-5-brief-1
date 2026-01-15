<?php

declare(strict_types=1);

namespace App\Controller;

use Core\Controller\AbstractController;
use Core\Http\Request;
use Core\Http\Response;

class AuthController extends AbstractController
{
    public function login(Request $request): Response
    {
        return $this->render('auth/login');
    }

    public function register(Request $request): Response
    {
        return $this->render('auth/register');
    }

    public function logout(): Response
    {
        return $this->render('auth/logout');
    }
}