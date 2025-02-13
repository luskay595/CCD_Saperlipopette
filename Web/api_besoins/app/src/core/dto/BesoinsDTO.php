<?php

namespace api_beosins\core\dto;

use api_besoins\core\dto\DTO;
use api_besoins\core\domain\entities\Besoins\Besoin;

class BesoinsDTO extends DTO implements \JsonSerializable
{
    protected int $besoin;
    public function __construct(Besoin $besoin)
    {
        $this->besoin = $besoin;
    }

    public function jsonSerialize(): array
    {
        return [
           'besoin' => $this->besoin
        ];
    }
}