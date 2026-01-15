<?php

namespace App\Repository;

use Core\Repository\AbstractRepository;
use src\Entity\Role;
use src\Entity\User;

class UserRepository extends AbstractRepository
{
    protected string $tableName = 'users';

    public function findByEmailAsObject(string $email): ?User
    {
        $data = $this->findByEmail($email);

        if (!$data) {
            return null;
        }

        return $this->mapToObject($data);
    }

    private function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare("SELECT u.*, r.name as role_name FROM {$this->tableName} as u INNER JOIN roles AS r ON u.role_id = r.id WHERE u.id = :email");
        $stmt->execute([':email' => $email]);
        $result = $stmt->fetch();

        return $result ?: null;
    }

    protected function mapToObject(array $data): User
    {
        $role = new Role($data['role_id'], $data['role_name']);

        return new User($data['id'], $data['name'], $data['email'], $data['password'], $role);
    }
}