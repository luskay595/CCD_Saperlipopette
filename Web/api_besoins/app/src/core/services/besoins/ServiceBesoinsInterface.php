<?php

namespace api_besoins\core\services\besoins;

use api_besoins\core\domain\entities\Besoins\Besoin;

interface ServiceBesoinsInterface{
    public function getBesoinById(int $id): Besoin;
    public function getAllBesoins(): array;
    public function getBesoinByLibelle(string $libelle): Besoin;
    public function getBesoinByClientNom(string $client_nom): Besoin;
    public function getBesoinByCompetenceType(string $competence_type): Besoin;
    public function createBesoin(string $libelle, string $client_nom, string $competence_type, array $services): void;
}