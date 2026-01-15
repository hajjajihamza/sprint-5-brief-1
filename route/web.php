<?php

use App\Controller\ {
    AuthController,
    AdminController,
    CandidatController,
    RecruteurController
};
use App\Middleware\ {
    AuthMiddleware,
    AdminMiddleware,
    CandidatMiddleware,
    RecruteurMiddleware
};
use Core\Router\Router;

Router::match(['GET', 'POST'],'/', [AuthController::class, 'login']);

Router::match(['GET', 'POST'],'/register', [AuthController::class, 'register']);

Router::get('/logout', [AuthController::class, 'logout']);

// Admin
Router::get('/admin', [AdminController::class, 'dashboard'])
    ->middleware([AuthMiddleware::class, AdminMiddleware::class])
;

// Candidat
Router::get('/candidat', [CandidatController::class, 'dashboard'])
    ->middleware([AuthMiddleware::class, CandidatMiddleware::class])
;

// Recruteur
Router::get('/recruteur', [RecruteurController::class, 'dashboard'])
    ->middleware([AuthMiddleware::class, RecruteurMiddleware::class])
;



