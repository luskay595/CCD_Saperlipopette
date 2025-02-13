<?php

namespace api_clients\core\domain\entities\Clients;

use api_clients\core\domain\entities\Entity;
use api_clients\core\dto\ClientDTO;

class Client extends Entity
{
    public string $id;
    public string $nom;

    public function __construct(string $id, string $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId(): String
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    // fonction toClientDTO
    public function toClientDTO(): ClientDTO
    {
        return new ClientDTO(
            $this->id,
            $this->nom,
        );
    }
}