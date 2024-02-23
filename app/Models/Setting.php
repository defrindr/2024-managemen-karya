<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'banner', 'deskripsi', 'informasi_kontak', 'social_media'
    ];

    public function getSocialMediasAttribute()
    {
        return json_decode($this->social_media) ?? [];
    }

    public function getBannerFolderPath()
    {
        return 'setting/';
    }

    public function getBannerPath()
    {
        return $this->getBannerFolderPath() . $this->banner;
    }

    public function getBannerUrlAttribute()
    {
        return asset($this->getBannerPath());
    }
}
