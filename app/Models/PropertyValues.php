<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyValues extends Model
{
    protected $table = 'property_values';

    protected $fillable = [
        'property_id',
        'value',
        'created_at',
        'updated_at',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }
}
