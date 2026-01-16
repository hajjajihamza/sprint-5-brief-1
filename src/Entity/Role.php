<?php

namespace App\Entity;

class Role
{
    private ?int $id;
    private string $name;

    public function __construct(?int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function isAdmin() :  bool
    {
        return $this->name === 'admin';
    }

    public function isCandidat() : bool
    {
        return $this->name === 'candidat';
    }

    public function isRecruteur() : bool
    {
        return $this->name === 'recruteur';
    }

    public function __toString(): string
    {
        return $this->name;
    }
}