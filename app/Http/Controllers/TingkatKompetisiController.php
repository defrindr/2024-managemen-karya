<?php

namespace App\Http\Controllers;

use App\Models\TingkatKompetisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TingkatKompetisiController extends Controller
{
    public function index()
    {
        $title = 'Tingkat Kompetisi';
        $items = TingkatKompetisi::paginate();
        return view('pages.admin.tingkat-kompetisi.index', compact('title', 'items'));
    }

    public function create()
    {
        $title = 'Tambah Tingkat Kompetisi';
        return view('pages.admin.tingkat-kompetisi.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            TingkatKompetisi::create($request->all());
            session()->flash('success', 'Tingkat Kompetisi berhasil ditambahkan');

            return Redirect::route('admin.master.tingkat-kompetisi.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan ketika menambahkan Tingkat Kompetisi' . $th->getMessage());

            return Redirect::route('admin.master.tingkat-kompetisi.create')->withInput();
        }
    }

    public function edit(TingkatKompetisi $item)
    {
        $title = 'Tambah Tingkat Kompetisi';
        return view('pages.admin.tingkat-kompetisi.edit', compact('title', 'item'));
    }

    public function update(Request $request, TingkatKompetisi $item)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            $item->update($request->all());
            session()->flash('success', 'Tingkat Kompetisi berhasil diubah');

            return Redirect::route('admin.master.tingkat-kompetisi.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan ketika mengubah Tingkat Kompetisi' . $th->getMessage());

            return Redirect::route('admin.master.tingkat-kompetisi.create')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TingkatKompetisi $item)
    {

        try {
            $item->delete();
            session()->flash('success', 'Tingkat Kompetisi berhasil dihapus');

            return Redirect::route('admin.master.tingkat-kompetisi.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan ketika menghapus Tingkat Kompetisi' . $th->getMessage());

            return Redirect::back();
        }
    }
}
