<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopyModel extends Model
{
    protected $table = 'copy';

    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
        'parent_id'
    ];
}
