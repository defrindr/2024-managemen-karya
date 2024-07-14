<?php

namespace App\Http\Controllers;

use App\Models\Karya;
use App\Models\KaryaTugas;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Matakuliah';
        $items = MataKuliah::orderBy('id', 'desc')->paginate();

        return view('pages.admin.matakuliah.index', compact('title', 'items'));
    }

    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        $title = 'Tambah Matakuliah';

        return view('pages.admin.matakuliah.create', compact('title'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'name' => 'required',
            'kode' => 'required|unique:mata_kuliah,kode'
        ]);

        try {
            MataKuliah::create($payload);
            session()->flash('success', 'Berhasil mengubah Matakuliah!');

            return Redirect::route('admin.master.matakuliah.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal menambahkan data!');
            return Redirect::route('admin.master.matakuliah.create')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKuliah $matakuliah)
    {
        $title = 'Ubah Matakuliah';

        return view('pages.admin.matakuliah.edit', compact('title', 'matakuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataKuliah $matakuliah)
    {
        $payload = $request->validate([
            'name' => 'required',
            'kode' => 'required'
        ]);
        try {
            $matakuliah->update($payload);
            session()->flash('success', 'Berhasil mengubah Matakuliah!');

            return Redirect::route('admin.master.matakuliah.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal menambahkan data!');

            return Redirect::route('admin.master.matakuliah.edit', $matakuliah)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKuliah $matakuliah)
    {
        try {
            $related = Karya::whereIn(
                'id',
                KaryaTugas::where('mata_kuliah_id', $matakuliah->id)->select('karya_id')
            )->get();
            foreach ($related as $item) $item->delete();
            $matakuliah->delete();
            session()->flash('success', 'Kategori berhasil dihapus!');

            return Redirect::route('admin.master.matakuliah.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal menghapus data!');

            return Redirect::route('admin.master.matakuliah.index');
        }
    }
}
