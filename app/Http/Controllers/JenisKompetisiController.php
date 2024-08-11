<?php

namespace App\Http\Controllers;

use App\Models\JenisKompetisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class JenisKompetisiController extends Controller
{
    public function index()
    {
        $title = 'Jenis Kompetisi';
        $items = JenisKompetisi::paginate();
        return view('pages.admin.jenis-kompetisi.index', compact('title', 'items'));
    }

    public function create()
    {
        $title = 'Tambah Jenis Kompetisi';
        return view('pages.admin.jenis-kompetisi.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            JenisKompetisi::create($request->all());
            session()->flash('success', 'Jenis Kompetisi berhasil ditambahkan');

            return Redirect::route('admin.master.jenis-kompetisi.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan ketika menambahkan Jenis Kompetisi' . $th->getMessage());

            return Redirect::route('admin.master.jenis-kompetisi.create')->withInput();
        }
    }

    public function edit(JenisKompetisi $item)
    {
        $title = 'Tambah Jenis Kompetisi';
        return view('pages.admin.jenis-kompetisi.edit', compact('title', 'item'));
    }

    public function update(Request $request, JenisKompetisi $item)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            $item->update($request->all());
            session()->flash('success', 'Jenis Kompetisi berhasil diubah');

            return Redirect::route('admin.master.jenis-kompetisi.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan ketika mengubah Jenis Kompetisi' . $th->getMessage());

            return Redirect::route('admin.master.jenis-kompetisi.create')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisKompetisi $item)
    {

        try {
            $item->delete();
            session()->flash('success', 'Jenis Kompetisi berhasil dihapus');

            return Redirect::route('admin.master.jenis-kompetisi.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan ketika menghapus Jenis Kompetisi' . $th->getMessage());

            return Redirect::back();
        }
    }
}
