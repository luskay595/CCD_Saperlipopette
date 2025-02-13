<?php

namespace api_clients\core\dto;

use api_clients\core\dto\DTO;
use api_clients\core\domain\entities\Clients\Client;

class ClientDTO extends DTO
{
    protected string $id;
    protected string $nom;

    public function __construct(string $id, string $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }



    public static function fromArray(array $data): Client
    {
        return new Client(
            $data['id'],
            $data['nom'],
        );
    }
}