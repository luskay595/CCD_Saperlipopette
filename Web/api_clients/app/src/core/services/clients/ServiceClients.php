<?php
namespace api_clients\application\actions;

use api_clients\core\dto\DTO;


class ServiceClients
{
    private $clientRepo;

    public function __construct($clientRepo)
    {
        $this->clientRepo = $clientRepo;
    }

    public function getClientById(int $id): DTO
    {
        return $this->clientRepo->getClientById($id);
    }

    public function getClientByName(string $nom): DTO
    {
        return $this->clientRepo->getClientByName($nom);
    }

    public function createClient(int $id, string $nom): void
    {
        $this->clientRepo->createClient($id, $nom);
    }
}