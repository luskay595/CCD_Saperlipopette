<?php

namespace api_besoins\core\services\besoins;

use api_besoins\core\services\besoins\ServiceBesoinsInterface;
use api_besoins\infrastructure\repository\BesoinRepository;
use api_besoins\core\domain\entities\Besoins\Besoin;

class ServiceBesoins implements ServiceBesoinsInterface{

    private BesoinRepository $repository;
    
    public function __construct(BesoinRepository $repository){
        $this->repository = $repository;
    }

    public function getBesoinById(int $id): Besoin{
        return $this->repository->getBesoinById($id);
    }

    public function getBesoinByLibelle(string $libelle): Besoin{
        return $this->repository->getBesoinByLibelle($libelle);
    }

    public function getBesoinByClientNom(string $client_nom): Besoin{
        return $this->repository->getBesoinByClientNom($client_nom);
    }

    public function getBesoinByCompetenceType(string $competence_type): Besoin{
        return $this->repository->getBesoinByCompetenceType($competence_type);
    }

    public function createBesoin(int $id, string $libelle, string $client_nom, string $competence_type, array $services): void{
        $this->repository->createBesoin($id, $libelle, $client_nom, $competence_type, $services);
    }

}