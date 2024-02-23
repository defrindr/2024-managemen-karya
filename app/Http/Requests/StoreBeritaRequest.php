<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeritaRequest extends FormRequest
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
            'judul' => 'required|min:5',
            'gambar' => 'required|file|mimes:jpg,png,gif,jpeg',
            'konten' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
            'min' => ':attribute setidaknya harus mempunyai panjang :min karakter',
            'file' => ':attribute harus berupa file gambar',
        ];
    }
}
