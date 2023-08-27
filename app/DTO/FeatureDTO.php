<?php

namespace App\DTO;

use App\Traits\DTOFromArray;

class FeatureDTO
{
    use DTOFromArray;

    public $name;

    public function __construct($name = null)
    {
        $this->name = $name;

    }

}