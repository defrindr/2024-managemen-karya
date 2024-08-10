<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TingkatKompetisi extends Model
{
    use HasFactory;
    protected $table = 'tingkat_kompetisi';

    protected $fillable = ['name'];
}
