<?php
namespace api_besoins\core\domain\entities\Besoins;

use api_besoins\core\dto\DTO;

class Besoin extends DTO{
    
    public $id;
    public $libelle;
    public $client_nom;
    public $competence_type;
    public $services;

    public function getId(){
        return $this->id;
    }

    public function getLibelle(){
        return $this->libelle;
    }

    public function getClientNom(){
        return $this->client_nom;
    }

    public function getCompetenceType(){
        return $this->competence_type;
    }

    public function getServices(){
        return $this->services;
    }
    public function __construct($id, $libelle, $client_nom, $competence_type, $services){
        $this->id = $id;
        $this->libelle = $libelle;
        $this->client_nom = $client_nom;
        $this->competence_type = $competence_type;
        $this->services = $services;
    }

}