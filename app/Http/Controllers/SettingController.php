<?php

namespace App\Http\Controllers;

use App\Helpers\RequestHelper;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $title = 'Pengaturan';
        $setting = Setting::first();
        $socialMedia = $setting->socialMedias;

        return view('pages.admin.setting.edit', compact('title', 'setting', 'socialMedia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request)
    {
        $setting = Setting::first();

        $payload = $request->validated();

        
        if ($request->has('banner')) {
            $response = RequestHelper::uploadImage($request->file('banner'), 'setting');
            if (! $response['success']) {
                session()->flash('error', 'Gambar gagal diunggah');

                return Redirect::route('admin.master.setting.edit')->withInput();
            }
            $payload['banner'] = $response['fileName'];
        } else {
            $payload['banner'] = $setting->banner;
        }

        
        try {
            $setting->update($payload);
            session()->flash('success', 'Pengaturan berhasil diubah');

            return Redirect::route('admin.master.setting.edit');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan ketika mengubah pengaturan'.$th->getMessage());

            return Redirect::route('admin.master.setting.edit')->withInput();
        }
    }
}
