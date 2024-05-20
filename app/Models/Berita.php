<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'judul',
        'konten',
        'gambar',
        'created_by',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getSummaryAttribute()
    {
        return strlen($this->konten) > 100 ? substr($this->konten, 0, 100) . '...' : $this->konten;
    }

    public function getImageFolderPath()
    {
        return 'storage/berita/';
    }

    public function getImagePath()
    {
        return $this->getImageFolderPath() . str_replace(" ", "%20", $this->gambar);
    }

    public function getImageUrlAttribute()
    {
        return asset($this->getImagePath());
    }

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
