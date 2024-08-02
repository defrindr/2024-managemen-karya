<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Karya extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'team_id', 'is_personal',
        // 'is_publish', 
        'judul', 'created_by', 'approved_by',
        'youtube_url',
        'project_url',
        'thumbnail',
        'views'
    ];

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

    public function kompetisi()
    {
        return $this->hasOne(KaryaKompetisi::class);
    }

    public function tugas()
    {
        return $this->hasOne(KaryaTugas::class);
    }

    public function project()
    {
        return $this->hasOne(KaryaProject::class);
    }

    public function getDetailAttribute()
    {
        if ($this->category_id == Category::KARYA_KOMPETISI) return $this->kompetisi;
        else if ($this->category_id == Category::KARYA_PROJECT) return $this->project;
        else return $this->tugas;
    }

    public function getStatusAttribute()
    {
        return $this->approved_by ? 'Disetujui' : 'Pending';
    }

    public function getKontributorAttribute()
    {
        if ($this->is_personal) {
            return $this->createdBy->name;
        } else {
            return "Kelompok " . $this->team->name;
        }
    }

    public function getDetailHtmlAttribute()
    {
        return view($this->getDetailTemplate(), $this->getDetailTemplateData());
    }

    public function getTemplateGuestAttribute()
    {
        return view($this->getTemplateGuest(), $this->getTemplateGuestData());
    }


    public function getTemplateGuest()
    {
        $category = $this->category;
        if ($category->id == Category::KARYA_PROJECT) {
            return 'pages.guest.karya.project';
        } else if ($category->id == Category::KARYA_TUGAS) {
            return 'pages.guest.karya.tugas';
        } else {
            return 'pages.guest.karya.kompetisi';
        }
    }

    public function getTemplateGuestData()
    {
        $category = $this->category;
        $karya = $this;
        $detail = $karya->detail;
        if ($category->id == Category::KARYA_PROJECT) {
            return compact('detail', 'karya');
        } else if ($category->id == Category::KARYA_TUGAS) {
            $listMatakuliah = MataKuliah::get();
            return compact('detail', 'listMatakuliah', 'karya');
        } else {
            $pesertas = KaryaAsset::where('karya_id', $karya->id)->where('tipe', 'peserta')->get();
            $kegiatans = KaryaAsset::where('karya_id', $karya->id)->where('tipe', 'kegiatan')->get();
            $posters = KaryaAsset::where('karya_id', $karya->id)->where('tipe', 'poster')->get();
            return compact(
                'karya',
                'detail',
                'pesertas',
                'kegiatans',
                'posters',
            );
        }
    }

    public function getDetailTemplate()
    {
        $category = $this->category;
        if ($category->id == Category::KARYA_PROJECT) {
            return 'pages.admin.karya.detail.project';
        } else if ($category->id == Category::KARYA_TUGAS) {
            return 'pages.admin.karya.detail.tugas';
        } else {
            return 'pages.admin.karya.detail.kompetisi';
        }
    }

    public function getDetailTemplateData()
    {
        $category = $this->category;
        $karya = $this;
        $detail = $karya->detail;
        if ($category->id == Category::KARYA_PROJECT) {
            return compact('detail', 'karya');
        } else if ($category->id == Category::KARYA_TUGAS) {
            $listMatakuliah = MataKuliah::get();
            return compact('detail', 'listMatakuliah', 'karya');
        } else {
            $assets = KaryaAsset::where('karya_id', $karya->id)->paginate();
            return compact('karya', 'detail', 'assets');
        }
    }

    public function getFormTemplate($category = null)
    {
        if (!$category)
            $category = $this->category;
        if ($category->id == Category::KARYA_PROJECT) {
            return 'pages.admin.karya.form.project';
        } else if ($category->id == Category::KARYA_TUGAS) {
            return 'pages.admin.karya.form.tugas';
        } else {
            return 'pages.admin.karya.form.kompetisi';
        }
    }

    public function getFormTemplateData($category = null)
    {
        if (!$category)
            $category = $this->category;
        $karya = $this;
        $detail = $karya->detail;
        if ($category->id == Category::KARYA_PROJECT) {
            return compact('detail', 'karya');
        } else if ($category->id == Category::KARYA_TUGAS) {
            $listMatakuliah = MataKuliah::get();
            return compact('detail', 'listMatakuliah', 'karya');
        } else {
            return compact('karya', 'detail');
        }
    }

    public function getScriptTemplate($category = null)
    {
        if (!$category)
            $category = $this->category;
        if ($category->id == Category::KARYA_PROJECT) {
            return 'pages.admin.karya.script.project';
        } else if ($category->id == Category::KARYA_TUGAS) {
            return 'pages.admin.karya.script.tugas';
        } else {
            return 'pages.admin.karya.script.kompetisi';
        }
    }

    public function getScriptTemplateData($category = null)
    {
        if (!$category)
            $category = $this->category;
        $karya = $this;
        $detail = $karya->detail;
        if ($category->id == Category::KARYA_PROJECT) {
            return compact('detail', 'karya');
        } else if ($category->id == Category::KARYA_TUGAS) {
            $listMatakuliah = MataKuliah::get();
            return compact('detail', 'listMatakuliah', 'karya');
        } else {
            return compact('karya', 'detail');
        }
    }

    public function isCreator()
    {
        if ($this->is_personal) return $this->created_by == auth()->id();
        else  return $this->created_by == auth()->id() || $this->team->isCreator();
    }

    public function getImageUrlAttribute()
    {
        $poster = KaryaAsset::where('karya_id', $this->id)->where('tipe', 'poster')->first();
        if ($poster) return $poster->fileUrl;
        return $this->thumbnailUrl;
    }

    public function getProjectAnchorAttribute()
    {
        if ($this->project_url == '-') return '-';
        return "<a href='{$this->project_url}' target='_blank'>$this->project_url</a>";
    }

    public function getYoutubeAnchorAttribute()
    {
        if ($this->youtube_url == '-') return '-';
        return "<a href='{$this->youtube_url}' target='_blank'>$this->youtube_url</a>";
    }

    public static function getFolderPath()
    {
        return 'categories/';
    }

    public function getPath()
    {
        return "/storage/" . self::getFolderPath() . $this->thumbnail;
    }

    public function getThumbnailUrlAttribute()
    {
        return asset($this->getPath());
    }
}
