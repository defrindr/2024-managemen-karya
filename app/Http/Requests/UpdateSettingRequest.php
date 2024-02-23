<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'judul' => 'required',
            'deskripsi' => 'required',
            'informasi_kontak' => 'required',
            'banner' => 'nullable|file|mimes:jpg,png,gif,jpeg',
            'social_media.twitter' => 'required',
            'social_media.facebook' => 'required',
            'social_media.twitter' => 'required',
            'social_media.instagram' => 'required',
            'social_media.skype' => 'required',
            'social_media.linkedin' => 'required',
        ];
    }
}
