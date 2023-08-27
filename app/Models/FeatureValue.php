<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureValue extends Model
{
    protected $table = 'feature_values';

    protected $fillable = [
        'feature_id',
        'value',
        'created_at',
        'updated_at',
    ];

    public function feature()
    {
        return $this->belongsTo(Feature::class, 'feature_id', 'id');
    }
}
