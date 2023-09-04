<?php

namespace App\DTO;

use App\Traits\DTOFromArray;

class PropertyValue
{
    use DTOFromArray;
    public $value;
    public $property_id;

    public function __construct($value = null, $property_id = null)
    {
        $this->value = $value;
        $this->property_id = $property_id;
    }
}
