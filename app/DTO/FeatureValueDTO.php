<?php

namespace App\DTO;

use App\Traits\DTOFromArray;

class FeatureValueDTO
{
    use DTOFromArray;
    public $value;
    public $feature_id;

    public function __construct($value = null, $feature_id = null)
    {
        $this->value = $value;
        $this->feature_id = $feature_id;
    }
}