<?php

declare(strict_types=1);

namespace App\Controller;

use Core\Controller\AbstractController;
use Core\Http\Response;

class CandidatController extends AbstractController
{
    public function dashboard(): Response
    {
        return $this->render('candidat/index');
    }
}