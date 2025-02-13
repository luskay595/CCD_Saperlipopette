<?php

namespace api_competences\core\domain\entities;

class Competence extends Entity {
    private int $id;
    private string $libelle;
    private string $description;
    private string $type;

    public function __construct(int $id, string $libelle, string $description, string $type) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->type = $type;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getLibelle(): string {
        return $this->libelle;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getType(): string {
        return $this->type;
    }
}