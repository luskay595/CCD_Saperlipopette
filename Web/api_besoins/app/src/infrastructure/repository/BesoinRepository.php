<?php

namespace api_besoins\infrastructure\repository;

use api_besoins\core\domain\entities\Besoins\Besoin;
use api_besoins\core\repositoryInterface\RepositoryBesoinInterface;
use PDO;

class BesoinRepository implements RepositoryBesoinInterface
{
    private PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    //récupère un besoin par son id dans la base de données
    public function getBesoinById($id): Besoin
    {
        $query = $this->db->prepare('SELECT * FROM besoin WHERE id = :id');
        $query->execute(['id' => $id]);
        $besoin = $query->fetch();
        $query = $this->db->prepare('SELECT * FROM besoins_services WHERE id_besoin = :id_besoin');
        $query->execute(['id_besoin' => $id]);
        $services = $query->fetchAll();
        return new Besoin($besoin['id'], $besoin['libelle'], $besoin['client_nom'], $besoin['competence_type'], $services);
    }

    //récupère tous les besoins dans la base de données
    public function getAllBesoins(): array
    {
        $query = $this->db->query('SELECT * FROM besoin');
        $besoins = $query->fetchAll();
        $besoinsArray = [];
        foreach ($besoins as $besoin) {
            $query = $this->db->prepare('SELECT * FROM besoins_services WHERE id_besoin = :id_besoin');
            $query->execute(['id_besoin' => $besoin['id']]);
            $services = $query->fetchAll();
            $besoinsArray[] = new Besoin($besoin['id'], $besoin['libelle'], $besoin['client_nom'], $besoin['competence_type'], $services);
        }
        return $besoinsArray;
    }

    //récupère un besoin par son libellé dans la base de données
    public function getBesoinByLibelle($libelle): Besoin
    {
        $query = $this->db->prepare('SELECT * FROM besoin WHERE libelle = :libelle');
        $query->execute(['libelle' => $libelle]);
        $besoin = $query->fetch();
        $query = $this->db->prepare('SELECT * FROM besoins_services WHERE id_besoin = :id_besoin');
        $query->execute(['id_besoin' => $besoin['id']]);
        $services = $query->fetchAll();
        return new Besoin($besoin['id'], $besoin['libelle'], $besoin['client_nom'], $besoin['competence_type'], $services);
    }

    //récupère un besoin par le nom de son client dans la base de données
    public function getBesoinByClientNom($clientNom): Besoin
    {
        $query = $this->db->prepare('SELECT * FROM besoin WHERE client_nom = :client_nom');
        $query->execute(['client_nom' => $clientNom]);
        $besoin = $query->fetch();
        $query = $this->db->prepare('SELECT * FROM besoins_services WHERE id_besoin = :id_besoin');
        $query->execute(['id_besoin' => $besoin['id']]);
        $services = $query->fetchAll();
        return new Besoin($besoin['id'], $besoin['libelle'], $besoin['client_nom'], $besoin['competence_type'], $services);
    }

    //récupère un besoin par le type de compétence dans la base de données
    public function getBesoinByCompetenceType($competenceType): Besoin
    {
        $query = $this->db->prepare('SELECT * FROM besoin WHERE competence_type = :competence_type');
        $query->execute(['competence_type' => $competenceType]);
        $besoin = $query->fetch();
        $query = $this->db->prepare('SELECT * FROM besoins_services WHERE id_besoin = :id_besoin');
        $query->execute(['id_besoin' => $besoin['id']]);
        $services = $query->fetchAll();
        return new Besoin($besoin['id'], $besoin['libelle'], $besoin['client_nom'], $besoin['competence_type'], $services);
    }

    //crée un besoin dans la base de données
    public function createBesoin(string $libelle, string $client_nom, string $competence_type, array $services): void
    {
        $query = $this->db->prepare('INSERT INTO besoin (libelle, client_nom, competence_type) VALUES (:libelle, :client_nom, :competence_type)');
        $query->execute([
            'libelle' => $libelle,
            'client_nom' => $client_nom,
            'competence_type' => $competence_type,
        ]);
        $id = $this->db->lastInsertId();
        foreach ($services as $service) {
            $query = $this->db->prepare('INSERT INTO besoins_services (id_besoin, id_service) VALUES (:id_besoin, :id_service)');
            $query->execute([
                'id_besoin' => $id,
                'id_service' => $service->id,
            ]);
        }
    }
}
