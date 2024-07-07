<?php

namespace App\Http\Controllers;

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
use App\Models\MataKuliah;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KaryaPersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Daftar Karya Personal';
        $items = Karya::where('is_personal', 1)->where('created_by', auth()->user()->id)->paginate();
        return view('pages.admin.karya-personal.index', compact('items', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category = null)
    {
        $title = 'Tambah Karya Baru';

        if ($category) {
            $karya = new Karya();
            $templateInput = view($karya->getFormTemplate($category), $karya->getFormTemplateData($category));
            $templateScript = view($karya->getScriptTemplate($category), $karya->getScriptTemplateData($category));
            return view('pages.admin.karya-personal.create-2', compact('title', 'templateInput', 'templateScript', 'category'));
        } else {
            $categories = Category::get();
            return view('pages.admin.karya-personal.create', compact('title', 'categories'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKaryaRequest $request)
    {
        $payload = $request->validated();

        $payload['is_personal'] = 1;
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
                $detail = KaryaKompetisi::create($payload_detail);
            }

            session()->flash('success', 'Karya berhasil ditambahkan');
            DB::commit();
            $karya_personal = $karya;
            return Redirect::route('admin.master.karya-personal.show', compact('karya_personal'));
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan ketika menambahkan karya' . $th->getMessage());

            return Redirect::route('admin.master.karya-personal.create', ['category_id' => $request->get('category_id')])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Karya $karyaPersonal)
    {
        $karya = $karyaPersonal;
        $title = 'Detail Karya';

        return view('pages.admin.karya-personal.show', compact('karya', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karya $karyaPersonal)
    {
        $karya = $karyaPersonal;
        $category = $karya->category;
        $title = 'Ubah karya';
        $categories = Category::all();

        $templateInput = view($karya->getFormTemplate(), $karya->getFormTemplateData());
        $templateScript = view($karya->getScriptTemplate(), $karya->getScriptTemplateData());

        return view('pages.admin.karya-personal.edit', compact('karya', 'title', 'categories', 'templateInput', 'templateScript'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKaryaRequest $request, Karya $karyaPersonal)
    {
        $karya_personal = $karyaPersonal;
        $karya = $karyaPersonal;
        $detail = $karyaPersonal->detail;
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
            $detail->update($payload);

            session()->flash('success', 'Berhasil mengubah karya');

            return Redirect::route('admin.master.karya-personal.show', compact('karya_personal'));
        } catch (\Throwable $th) {
            throw $th;
            session()->flash('error', 'Gagal mengubah karya');

            return Redirect::route('admin.master.karya-personal.edit', compact('karya_personal'))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karya $karyaPersonal)
    {
        $karya = $karyaPersonal;

        try {
            $karya->delete();
            session()->flash('success', 'Berhasil menghapus karya');

            return Redirect::route('admin.master.karya-personal.index');
        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('error', 'Gagal menghapus karya');
            return Redirect::route('admin.master.karya-personal.index');
        }
    }
}
