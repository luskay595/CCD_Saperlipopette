<?php

/* fair l'interface*/
namespace api_clients\core\services\clients;

use api_clients\core\domain\entities\Clients\Client;

interface ServiceClientInterface
{
    public function getClientById(int $id): Client;
    public function getClientByNom(string $nom): Client;
    public function createClient(int $id, string $nom): void;
}