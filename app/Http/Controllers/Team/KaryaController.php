<?php

namespace App\Http\Controllers\Team;

use App\Helpers\RequestHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKaryaRequest;
use App\Http\Requests\UpdateKaryaRequest;
use App\Models\Category;
use App\Models\Karya;
use App\Models\KaryaAsset;
use App\Models\KaryaKompetisi;
use App\Models\KaryaProject;
use App\Models\KaryaTugas;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KaryaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Team $team, Category $category = null)
    {
        $title = 'Tambah Karya Baru';

        if ($category) {
            $karya = new Karya();
            $templateInput = view($karya->getFormTemplate($category), $karya->getFormTemplateData($category));
            $templateScript = view($karya->getScriptTemplate($category), $karya->getScriptTemplateData($category));
            return view('pages.admin.team.karya.create-2', compact('title', 'templateInput', 'templateScript', 'category', 'team'));
        }
        $categories = Category::all();
        return view('pages.admin.team.karya.create', compact('title', 'categories', 'team'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKaryaRequest $request, Team $team)
    {
        $payload = $request->validated();

        $payload['team_id'] = $team->id;
        $payload['created_by'] = auth()->user()->id;

        DB::beginTransaction();
        try {
            $response = RequestHelper::uploadImage($request->file('thumbnail'), KaryaAsset::getFolderPath());
            if (!$response['success']) {
                session()->flash('error', 'Ikon gagal diunggah');

                return Redirect::back()->withInput();
            }
            $payload['thumbnail'] = $response['fileName'];
            $karya = Karya::create($payload);

            $payload_detail = array_merge($payload, ['karya_id' => $karya->id]);
            $detail = false;

            if ($karya->category_id == Category::KARYA_PROJECT) {
                $detail = KaryaProject::create($payload_detail);
            } else if ($karya->category_id == Category::KARYA_TUGAS) {
                $detail = KaryaTugas::create($payload_detail);
            } else {
                // $payload['jumlah_peserta'] = $team->members()->count();
                $detail = KaryaKompetisi::create($payload_detail);
            }

            session()->flash('success', 'Karya berhasil ditambahkan');
            DB::commit();
            return Redirect::route('admin.master.team.karya.show', compact('karya', 'team'));
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan ketika menambahkan karya' . $th->getMessage());

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

        $templateInput = view($karya->getFormTemplate(), $karya->getFormTemplateData());

        return view('pages.admin.team.karya.edit', compact('team', 'karya', 'title', 'categories', 'templateInput'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKaryaRequest $request, Team $team, Karya $karya)
    {
        $payload = $request->validated();

        try {
            if ($request->has('thumbnail')) {
                $response = RequestHelper::uploadImage($request->file('thumbnail'), KaryaAsset::getFolderPath());
                if (!$response['success']) {
                    session()->flash('error', 'Ikon gagal diunggah');

                    return Redirect::back()->withInput();
                }
                $payload['thumbnail'] = $response['fileName'];
            } else {
                $payload['thumbnail'] = $karya->thumbnail;
            }
            $karya->update($payload);
            $karya->detail->update($payload);
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
    public function destroy(Team $team, Karya $karya)
    {

        try {
            $karya->delete();
            session()->flash('success', 'Berhasil menghapus karya');

            return Redirect::route('admin.master.team.show', compact('team'));
        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('error', 'Gagal menghapus karya');
            return Redirect::route('admin.master.team.show', compact('team'));
        }
    }
}
