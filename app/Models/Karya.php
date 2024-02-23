<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Karya extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'gambar', 'deskripsi', 'link_youtube', 'category_id', 'team_id', 'created_by', 'approved_by'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function getStatusAttribute()
    {
        return $this->approved_by ? 'Disetujui' : 'Pending';
    }

    public function getSummaryAttribute()
    {
        return strlen($this->deskripsi) > 100 ? substr($this->deskripsi, 0, 100).'...' : $this->deskripsi;
    }

    public function getImageFolderPath()
    {
        return 'karya/';
    }

    public function getImagePath()
    {
        return $this->getImageFolderPath().$this->gambar;
    }

    public function getImageUrlAttribute()
    {
        return asset($this->getImagePath());
    }
}
