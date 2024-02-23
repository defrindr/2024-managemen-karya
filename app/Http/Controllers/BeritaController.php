<?php

namespace App\Http\Controllers;

use App\Helpers\RequestHelper;
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;
use App\Models\Berita;
use Illuminate\Support\Facades\Redirect;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Berita';
        $items = Berita::orderBy('id', 'desc')->paginate(10);

        return view('pages.admin.berita.index', compact('title', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Berita';

        return view('pages.admin.berita.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBeritaRequest $request)
    {
        $payload = $request->validated();

        $response = RequestHelper::uploadImage($request->file('gambar'), 'berita');
        if (! $response['success']) {
            session()->flash('error', 'Gambar gagal diunggah');
            dd(1);

            return Redirect::route('admin.master.berita.create')->withInput();
        }

        $payload['gambar'] = $response['fileName'];
        $payload['created_by'] = auth()->user()->id;

        try {
            $beritum = Berita::create($payload);
            session()->flash('success', 'Berita berhasil ditambahkan');

            return Redirect::route('admin.master.berita.show', $beritum);
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan ketika menambahkan berita'.$th->getMessage());

            return Redirect::route('admin.master.berita.create')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $beritum)
    {
        $title = 'Detail Berita';

        return view('pages.admin.berita.show', compact('title', 'beritum'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $beritum)
    {
        $title = 'Ubah Berita';

        return view('pages.admin.berita.edit', compact('title', 'beritum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBeritaRequest $request, Berita $beritum)
    {
        $payload = $request->validated();

        if ($request->has('gambar')) {
            $response = RequestHelper::uploadImage($request->file('gambar'), 'berita');
            if (! $response['success']) {
                session()->flash('error', 'Gambar gagal diunggah');

                return Redirect::route('admin.master.berita.edit', compact('beritum'))->withInput();
            }
            $payload['gambar'] = $response['fileName'];
        } else {
            $payload['gambar'] = $beritum->gambar;
        }

        try {
            $beritum->update($payload);
            session()->flash('success', 'Berita berhasil diubah');

            return Redirect::route('admin.master.berita.show', compact('beritum'));
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan ketika mengubah berita'.$th->getMessage());

            return Redirect::route('admin.master.berita.edit', compact('beritum'))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $beritum)
    {

        try {
            $beritum->delete();
            session()->flash('success', 'Berita berhasil dihapus');

            return Redirect::route('admin.master.berita.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan ketika menghapus berita'.$th->getMessage());

            return Redirect::back();
        }
    }
}
