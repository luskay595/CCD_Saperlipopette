<?php

namespace api_clients\core\dto;

use api_clients\core\dto\DTO;
use api_clients\core\domain\entities\Clients\Client;

class ClientDTO extends DTO
{
    protected int $id;
    protected string $nom;

    public function __construct(int $id, string $nom, string $email)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getnom(): string
    {
        return $this->nom;
    }



    public static function fromArray(array $data): Client
    {
        return new Client(
            $data['id'],
            $data['nom'],
        );
    }
}