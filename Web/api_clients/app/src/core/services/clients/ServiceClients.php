<?php
namespace api_clients\core\services\clients;

use api_clients\core\domain\entities\Clients\Client;
use api_clients\core\dto\DTO;
use api_clients\infrastructure\repository\ClientRepository;

class ServiceClients implements ServiceClientInterface
{
    private ClientRepository $clientRepo;

    public function __construct(ClientRepository $clientRepo)
    {
        $this->clientRepo = $clientRepo;
    }

    public function getAllClients(): array
    {
        return $this->clientRepo->getAllClients();
    }

    public function getClientById($id): Client
    {
        return $this->clientRepo->getClientById($id);
    }

    public function getClientByNom(string $nom): Client
    {
        return $this->clientRepo->getClientByNom($nom);
    }

    public function createClient(string $id, string $nom): void
    {
        $this->clientRepo->createClient($id, $nom);
    }
}