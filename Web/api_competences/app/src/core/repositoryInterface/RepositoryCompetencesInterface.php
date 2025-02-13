<?php

namespace api_competences\core\repositoryInterface;

use api_competences\core\domain\entities\Competence;

interface RepositoryCompetencesInterface
{
    public function getCompetenceById(int $id): Competence;
    public function getCompetenceByLibelle(string $libelle): Competence;
    public function createCompetence(int $id, string $libelle, string $description, string $type): void;
}