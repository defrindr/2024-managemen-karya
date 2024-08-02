<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Category;
use App\Models\Karya;
use App\Models\Setting;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $appName = $setting->judul ?? config('app.name');
        $appDescription = $setting->deskripsi ?? '';
        $appBanner = "storage/" . $setting->bannerUrl;
        $socialMedias = $setting->socialMedias;

        $listKategori = Category::get();
        $filterKarya = Category::get();
        $listKarya = Karya::limit(9)->orderBy('id', 'desc')->whereNotNull('approved_by')->get();
        $listBerita = Berita::orderBy('id', 'desc')->limit(6)->get();

        return view('pages.guest.index', compact('appName', 'appBanner', 'listKategori', 'filterKarya', 'listKarya', 'socialMedias', 'listBerita', 'appDescription'));
    }

    public function karya(Request $request)
    {
        $setting = Setting::first();
        $appName = $setting->judul ?? config('app.name');
        $socialMedias = $setting->socialMedias;

        $listKategori = Category::get();

        $qb = Karya::query()->whereNotNull('approved_by')->orderBy('id', 'desc');

        if ($request->has('kategori')) {
            $qb->where('category_id', $request->kategori);
        }


        if ($request->has('filter')) {

            if ($request->filter === "terpopuler") {
                $qb->orderBy('views', 'desc');
            } else  if ($request->filter === "az") {
                $qb->orderBy('name', 'asc');
            } else  if ($request->filter === "terlama") {
                $qb->orderBy('created_at', 'asc');
            }
        }

        $listKarya = $qb->paginate();

        return view('pages.guest.karya', compact('appName', 'socialMedias', 'listKategori', 'listKarya'));
    }

    public function karyaShow(Request $request, Karya $karya)
    {
        $setting = Setting::first();
        $appName = $setting->judul ?? config('app.name');
        $socialMedias = $setting->socialMedias;

        $karya->update(['views' => $karya->views + 1]);

        return view('pages.guest.karya-show', compact('appName', 'socialMedias', 'karya'));
    }

    public function berita(Request $request)
    {
        $setting = Setting::first();
        $appName = $setting->judul ?? config('app.name');
        $socialMedias = $setting->socialMedias;

        $listBerita = Berita::orderBy('id', 'desc')->paginate();

        return view('pages.guest.berita', compact('appName', 'socialMedias', 'listBerita'));
    }

    public function beritaShow(Request $request, Berita $berita)
    {
        $setting = Setting::first();
        $appName = $setting->judul ?? config('app.name');
        $socialMedias = $setting->socialMedias;

        return view('pages.guest.berita-show', compact('appName', 'socialMedias', 'berita'));
    }
}
