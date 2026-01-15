<?php

namespace Core\Repository;

use Core\Connection\Connection;

abstract class AbstractRepository
{
    protected \PDO $pdo;
    protected string $tableName;
    public function __construct(Connection $connection)
    {
        $this->pdo = $connection->getConnection();
    }

    protected function findAll(): array
    {
        return $this->pdo->query("SELECT * FROM {$this->tableName}")->fetchAll();
    }
    protected function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->tableName} WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();

        return $result ?: null;
    }

    abstract protected function mapToObject(array $data): object;
}