<?php

namespace api_competences\core\domain\entities;
abstract class Entity
{
    public function __get(string $name): mixed
    {
        return property_exists($this, $name) ? $this->$name : throw new \Exception(static::class . ": Property $name does not exist");
    }

}