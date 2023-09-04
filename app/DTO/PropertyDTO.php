<?php

namespace App\DTO;

use App\Traits\DTOFromArray;

class PropertyDTO
{
    use DTOFromArray;

    public $name;

    public function __construct($name = null)
    {
        $this->name = $name;

    }
}
