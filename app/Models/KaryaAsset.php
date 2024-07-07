<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryaAsset extends Model
{
    use HasFactory;

    protected $table = 'karya_asset';
    protected $fillable = ['karya_id', 'tipe', 'file', 'keterangan'];

    public static function getFolderPath()
    {
        return 'categories/';
    }

    public function getPath()
    {
        return "/storage/" . self::getFolderPath() . $this->file;
    }

    public function getFileUrlAttribute()
    {
        return asset($this->getPath());
    }
}
