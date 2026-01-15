<?php

namespace App\Repository;

use Core\Repository\AbstractRepository;
use src\Entity\Role;

class RoleRepository extends AbstractRepository
{
    public function findAsObject(int $id): ?Role
    {
        $data = $this->find($id);

        if (!$data) {
            return null;
        }

        return $this->mapToObject($data);
    }

    public function mapToObject(array $data): Role
    {
        return new Role(isset($data['id']) ? (int) $data['id'] : null, $data['name']);
    }
}