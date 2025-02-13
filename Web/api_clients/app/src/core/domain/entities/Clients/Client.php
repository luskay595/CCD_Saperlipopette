<?php

namespace api_clients\core\domain\entities\Clients;

use api_clients\core\domain\entities\Entity;

class Client extends Entity
{
    protected int $id;
    protected string $nom;

    public function __construct(int $id, string $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }
}