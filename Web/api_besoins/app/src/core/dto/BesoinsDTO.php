<?php

namespace api_beosins\core\dto;

use api_besoins\core\dto\DTO;
use api_besoins\core\domain\entities\Besoins\Besoin;

class BesoinsDTO extends DTO
{
   protected int $id;
    protected string $libelle;
    protected string $client_nom;
    protected string $competence_type;

    protected array $services;


    public  function getId(): int
    {
        return $this->id;
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

    public function __construct(int $id, string $libelle, string $client_nom, string $competence_type, array $services)
    {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->client_nom = $client_nom;
        $this->competence_type = $competence_type;
        $this->services = $services;
    }

    public static function fromArray(array $data): Besoin
    {
        return new Besoin(
            $data['id'],
            $data['libelle'],
            $data['client_nom'],
            $data['competence_type'],
            $data['services']
        );
    }

}