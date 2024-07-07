<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryaTugas extends Model
{
    use HasFactory;

    protected $table = "karya_tugas";
    protected $fillable = [
        "karya_id",
        "mata_kuliah_id",
        "deskripsi"
    ];
}
