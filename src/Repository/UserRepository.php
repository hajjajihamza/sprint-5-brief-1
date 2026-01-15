<?php

namespace App\Repository;

use Core\Repository\AbstractRepository;
use src\Entity\Role;
use src\Entity\User;

class UserRepository extends AbstractRepository
{
    protected string $tableName = 'users';

    public function create(User $user): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->tableName} (name, email, password, role_id) VALUES (:name, :email, :password, :role_id)");
        $success = $stmt->execute([
            ':name' => $user->getName(),
            ':email' => $user->getEmail(),
            ':password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            ':role_id' => $user->getRole()->getId(),
        ]);

        if ($success) {
            $user->setId((int) $this->pdo->lastInsertId());
        }

        return $success;
    }

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

    public function mapToObject(array $data): User
    {
        $role = new Role($data['role_id'], $data['role_name']);

        return new User(isset($data['id']) ? (int) $data['id'] : null, $data['name'], $data['email'], $data['password'], $role);
    }
}