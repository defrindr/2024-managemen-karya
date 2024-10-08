<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryaKompetisi extends Model
{
    use HasFactory;

    protected $table = 'karya_kompetisi';

    protected $fillable = [
        'karya_id',
        'jenis_kompetisi',
        'tingkat_kompetisi',
        'tempat_kompetisi',
        'tanggal_mulai',
        'tanggal_akhir',
        'jumlah_peserta',
        'penghargaan',
        'deskripsi'
    ];

    public function jenisKompetisi()
    {
        return $this->belongsTo(JenisKompetisi::class, 'jenis_kompetisi');
    }

    public function tingkatKompetisi()
    {
        return $this->belongsTo(TingkatKompetisi::class, 'tingkat_kompetisi');
    }
}
