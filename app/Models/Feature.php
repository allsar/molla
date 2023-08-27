<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'features';

    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
    ];
}
