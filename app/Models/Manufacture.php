<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    protected $table = 'manufactures';

    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
    ];
}
