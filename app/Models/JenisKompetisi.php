<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKompetisi extends Model
{
    use HasFactory;

    protected $table = 'jenis_kompetisi';

    protected $fillable = ['name'];
}
