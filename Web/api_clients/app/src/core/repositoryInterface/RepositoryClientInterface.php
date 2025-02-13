<?php

namespace api_clients\core\repositoryInterface;

use api_clients\core\domain\entities\Clients\Client;

interface RepositoryClientInterface
{
    public function getClientById(string $id): Client;
    public function getAllClients(): array;
    public function getClientByNom(string $nom): Client;
    public function createClient(string $id, string $nom): void;
}