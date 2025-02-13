<?php

namespace api_clients\infrastructure\repository;

use api_clients\core\domain\entities\Clients\Client;
use api_clients\core\repositoryInterfaces\RepositoryClientInterface;
use PDO;

class ClientRepository implements RepositoryClientInterface
{
    private PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Récupère un client par son id dans la base de données
    public function getClientById($id): Client
    {
        $query = $this->db->prepare('SELECT * FROM clients WHERE id = :id');
        $query->execute(['id' => $id]);
        $client = $query->fetch();
        return new Client($client['id'], $client['nom']);
    }

    // Récupère un client par son nom dans la base de données
    public function getClientByNom($nom): Client
    {
        $query = $this->db->prepare('SELECT * FROM clients WHERE nom = :nom');
        $query->execute(['nom' => $nom]);
        $client = $query->fetch();
        return new Client($client['id'], $client['nom']);
    }

    // Crée un client dans la base de données
    public function createClient(int $id, string $nom, ): void
    {
        $query = $this->db->prepare('INSERT INTO clients (id, nom ) VALUES (:id, :nom )');
        $query->execute([
            'id' => $id,
            'nom' => $nom,
        ]);
    }
}