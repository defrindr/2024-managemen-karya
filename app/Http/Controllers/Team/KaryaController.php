<?php

namespace App\Http\Controllers\Team;

use App\Helpers\RequestHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKaryaRequest;
use App\Http\Requests\UpdateKaryaRequest;
use App\Models\Category;
use App\Models\Karya;
use App\Models\Team;
use Illuminate\Support\Facades\Redirect;

class KaryaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.team.karya.index', compact('karya'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Team $team)
    {
        $title = 'Tambah Karya Baru';
        $categories = Category::all();

        return view('pages.admin.team.karya.create', compact('title', 'categories', 'team'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKaryaRequest $request, Team $team)
    {
        $payload = $request->validated();

        $response = RequestHelper::uploadImage($request->file('gambar'), 'karya');
        if (! $response['success']) {
            session()->flash('error', 'Gambar gagal diunggah');

            return Redirect::route('admin.master.team.karya.create', compact('team'));
        }
        $payload['gambar'] = $response['fileName'];

        $payload['team_id'] = $team->id;
        $payload['created_by'] = auth()->user()->id;

        try {
            $karya = Karya::create($payload);
            session()->flash('success', 'Karya berhasil ditambahkan');

            return Redirect::route('admin.master.team.karya.show', compact('karya', 'team'));
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan ketika menambahkan karya'.$th->getMessage());

            return Redirect::route('admin.master.team.karya.create', compact('team'))->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team, Karya $karya)
    {
        $title = 'Detail Karya';

        return view('pages.admin.team.karya.show', compact('team', 'karya', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team, Karya $karya)
    {
        $title = 'Ubah karya';
        $categories = Category::all();

        return view('pages.admin.team.karya.edit', compact('team', 'karya', 'title', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKaryaRequest $request, Team $team, Karya $karya)
    {
        $payload = $request->validated();

        try {

            if ($request->has('gambar')) {
                $response = RequestHelper::uploadImage($request->file('gambar'), 'karya');
                if (! $response['success']) {
                    session()->flash('error', 'Gambar gagal diunggah');

                    return Redirect::route('admin.master.team.karya.edit', compact('karya', 'team'))->withInput();
                }
                $payload['gambar'] = $response['fileName'];
            }

            $karya->update($payload);
            session()->flash('success', 'Berhasil mengubah karya');

            return Redirect::route('admin.master.team.karya.show', compact('karya', 'team'));
        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('error', 'Gagal mengubah karya');

            return Redirect::route('admin.master.team.karya.edit', compact('karya', 'team'))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karya $karya)
    {
        //
    }
}
