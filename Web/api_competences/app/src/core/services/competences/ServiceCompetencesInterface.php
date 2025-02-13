<?php

namespace api_competences\core\services\competences;

use api_competences\core\domain\entities\Competence;

interface ServiceCompetencesInterface
{
    public function getAllCompetences(): array;
    public function getCompetenceById(int $id): Competence;
    public function getCompetenceByLibelle(string $libelle): Competence;
    public function getCompetenceByType(string $type): Competence;
    public function createCompetence(string $libelle, string $description, string $type): void;
}