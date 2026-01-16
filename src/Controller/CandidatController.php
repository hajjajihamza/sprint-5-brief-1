<?php

declare(strict_types=1);

namespace App\Controller;

use Core\Controller\AbstractController;
use Core\Http\Request;
use Core\Http\Response;

class CandidatController extends AbstractController
{
    public function dashboard(Request $request): Response
    {
        return $this->render('candidat/index', ['request' => $request]);
    }
}