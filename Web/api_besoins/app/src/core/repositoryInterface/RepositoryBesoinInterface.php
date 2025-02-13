<?php

namespace api_besoins\core\repositoryInterfaces;

use api_besoins\core\domain\entities\besoins\Besoin;

interface RepositoryBesoinInterface
{
    public function getBesoinById(int $id): Besoin;
    public function getBesoinByLibelle(string $libelle): Besoin;
    public function getBesoinByClientNom(string $client_nom): Besoin;
    public function getBesoinByCompetenceType(string $competence_type): Besoin;
    public function createBesoin(int $id, string $libelle, string $client_nom, string $competence_type, array $services): void;
}