<?php

namespace api_competences\infrastructure\repository;

use PDO;
use api_competences\core\domain\entities\Competence;

class CompetenceRepository {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM competences');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new Competence($row['id'], $row['libelle'], $row['description'], $row['type']), $results);
    }

    public function findById(int $id): ?Competence {
        $stmt = $this->pdo->prepare('SELECT * FROM competences WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Competence($row['id'], $row['libelle'], $row['description'], $row['type']) : null;
    }

    public function save(Competence $competence): void {
        $stmt = $this->pdo->prepare('INSERT INTO competences (libelle, description, type) VALUES (:libelle, :description, :type)');
        $stmt->execute([
            'libelle' => $competence->getLibelle(),
            'description' => $competence->getDescription(),
            'type' => $competence->getType()
        ]);
    }
}