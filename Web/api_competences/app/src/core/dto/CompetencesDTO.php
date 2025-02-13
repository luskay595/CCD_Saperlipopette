<?php

namespace api_competences\core\dto;

use Respect\Validation\Validator as v;
use api_competences\core\dto\DTO;

class CompetencesDTO extends DTO
{
    public int $id;
    public string $libelle;
    public string $description;
    public string $type;

    public function __construct(int $id, string $libelle, string $description, string $type)
    {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->type = $type;

        $this->setBusinessValidator(
            v::attribute('libelle', v::stringType()->notEmpty())
            ->attribute('description', v::stringType()->notEmpty())
            ->attribute('type', v::stringType()->notEmpty())
        );
    }
}