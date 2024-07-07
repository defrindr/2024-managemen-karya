<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryaProject extends Model
{
    use HasFactory;

    protected $table = 'karya_project';

    protected $fillable = [
        'karya_id',
        'deskripsi',
    ];
}
