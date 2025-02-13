<?php

namespace api_besoins\core\dto;

use api_besoins\core\dto\DTO;
use api_besoins\core\domain\entities\Besoins\Besoin;

class InputBesoinsDTO extends DTO
{

    protected string $libelle;
    protected string $client_nom;
    protected string $competence_type;

    protected array $services;

    public function __construct(string $libelle, string $client_nom, string $competence_type, array $services)
    {
        $this->libelle = $libelle;
        $this->client_nom = $client_nom;
        $this->competence_type = $competence_type;
        $this->services = $services;
    }

    public  function getLibelle(): string
    {
        return $this->libelle;
    }

    public  function getClientNom(): string
    {
        return $this->client_nom;
    }

    public  function getCompetenceType(): string
    {
        return $this->competence_type;
    }

    public  function getServices(): array
    {
        return $this->services;
    }

}