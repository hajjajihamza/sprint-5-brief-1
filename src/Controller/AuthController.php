<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Core\Controller\AbstractController;
use Core\Database\Connection;
use Core\Http\Request;
use Core\Http\Response;

class AuthController extends AbstractController
{
    private UserRepository $userRepository;
    private RoleRepository $roleRepository;
    public function __construct()
    {
        $connection = new Connection();
        $this->userRepository = new UserRepository($connection);
        $this->roleRepository = new RoleRepository($connection);
    }

    public function login(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $email = $request->input('email');
            $password = $request->input('password');

            $user = $this->userRepository->findByEmailAsObject($email);
            if ($user && password_verify($password, $user->getPassword())) {
                $request->setSession('user', $user);
                if ($user->getRole()->isAdmin()) {
                    $this->redirectToPath('/admin');
                } elseif ($user->getRole()->isCandidat()) {
                    $this->redirectToPath('/candidat');
                } else {
                    $this->redirectToPath('/recruteur');
                }
            }
        }

        return $this->render('auth/login');
    }

    public function register(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');
            $role_id = $request->input('role_id');

            $role = $this->roleRepository->findAsObject($role_id);

            $this->userRepository->create($this->userRepository->mapToObject([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role_id' => $role?->getId(),
                'role_name' => $role?->getName(),
            ]));

            $this->redirectToPath('/login');
        }

        return $this->render('auth/register');
    }

    public function logout(Request $request): Response
    {
        $request->setSession('user', null);
        $request->session()->destroy();
        $this->redirectToPath('/login');
    }
}