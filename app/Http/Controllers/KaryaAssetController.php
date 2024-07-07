<?php

namespace App\Http\Controllers;

use App\Helpers\RequestHelper;
use App\Models\Karya;
use App\Models\KaryaAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class KaryaAssetController extends Controller
{
  public function create(Karya $karya, Request $request)
  {
    $title = 'Tambah Aset';
    $redirect = $request->get('redirect');
    return view('pages.admin.karya.asset.create', compact('karya', 'title', 'redirect'));
  }
  public function store(Request $request, Karya $karya)
  {
    // dd($request->all());
    $payload = $request->validate([
      'file' => 'required',
      'keterangan' => 'required',
      'tipe' => 'required'
    ]);
    $redirect = $request->get('redirect');

    $payload['karya_id'] = $karya->id;
    try {
      $response = RequestHelper::uploadImage($request->file('file'), KaryaAsset::getFolderPath());
      if (!$response['success']) {
        session()->flash('error', 'Ikon gagal diunggah');

        return Redirect::back()->withInput();
      }
      $payload['file'] = $response['fileName'];
      KaryaAsset::create($payload);
      session()->flash('success', 'Berhasil menambahkan asset!');
      if ($redirect) return Redirect::to($redirect);
      return Redirect::to('/admin/home');
    } catch (\Throwable $th) {
      // dd($th);
      session()->flash('error', 'Gagal menambahkan asset!');
      return redirect()->back()->withInput();
    }
  }
  public function edit(Karya $karya, KaryaAsset $asset, Request $request)
  {
    $title = 'Edit Aset';
    $redirect = $request->get('redirect');
    return view('pages.admin.karya.asset.edit', compact('karya', 'asset', 'title', 'redirect'));
  }
  public function update(Karya $karya, KaryaAsset $asset, Request $request)
  {
    // dd($request->all());
    $payload = $request->validate([
      'file' => 'nullable',
      'keterangan' => 'required',
      'tipe' => 'required'
    ]);
    $redirect = $request->get('redirect');

    $payload['karya_id'] = $karya->id;
    try {
      if ($request->has('file')) {
        $response = RequestHelper::uploadImage($request->file('file'), KaryaAsset::getFolderPath());
        if (!$response['success']) {
          session()->flash('error', 'Ikon gagal diunggah');

          return Redirect::back()->withInput();
        }
        $payload['file'] = $response['fileName'];
      } else {
        $payload['file'] = $asset->file;
      }
      $asset->update($payload);
      session()->flash('success', 'Berhasil menambahkan asset!');
      if ($redirect) return Redirect::to($redirect);
      return Redirect::to('/admin/home');
    } catch (\Throwable $th) {
      session()->flash('error', 'Gagal menambahkan asset!');
      return redirect()->back()->withInput();
    }
  }
  public function destroy(Karya $karya, KaryaAsset $asset)
  {
    try {
      $asset->delete();
      session()->flash('success', 'Berrhasil menghapus asset!');
    } catch (\Throwable $th) {
      session()->flash('error', 'Gagal menghapus asset!');
    }
    return redirect()->back();
  }
}
