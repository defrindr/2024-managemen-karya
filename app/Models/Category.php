<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    const KARYA_KOMPETISI = 1;
    const KARYA_PROJECT = 2;
    const KARYA_TUGAS = 3;
    protected $fillable = ['name', 'icon'];

    public function getIconFolderPath()
    {
        return 'categories/';
    }

    public function getIconPath()
    {
        return "/storage/".$this->getIconFolderPath().$this->icon;
    }

    public function getUrlAttribute()
    {
        return asset($this->getIconPath());
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->name);
    }
}
