<?php

namespace api_competences\core\services\competences;

use api_competences\core\services\competences\ServiceCompetencesInterface;
use api_competences\infrastructure\repository\CompetenceRepository;
use api_competences\core\domain\entities\Competence;

class ServiceCompetences implements ServiceCompetencesInterface {

    private CompetenceRepository $repository;

    public function __construct(CompetenceRepository $repository) {
        $this->repository = $repository;
    }

    public function getAllCompetences(): array {
        return $this->repository->getAllCompetences();
    }

    public function getCompetenceById(int $id): Competence {
        return $this->repository->getCompetenceById($id);
    }

    public function getCompetenceByLibelle(string $libelle): Competence {
        return $this->repository->getCompetenceByLibelle($libelle);
    }

    public function getCompetenceByType(string $type): Competence {
        return $this->repository->getCompetenceByType($type);
    }

    public function createCompetence(string $libelle, string $description, string $type): void {
        $this->repository->createCompetence($libelle, $description, $type);
    }
}