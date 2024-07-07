<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKaryaRequest extends FormRequest
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
        $categoryId = request()->get('category_id');

        $rules = [
            'category_id' => 'required',
            'judul' => 'required|min:5',
        ];

        if ($categoryId == 3) {
            $rules = array_merge($rules, [
                'thumbnail' => 'required',
                'deskripsi' => 'required',
                'mata_kuliah_id' => 'required',
            ]);
        } else if ($categoryId == 2) {
            $rules = array_merge($rules, [
                'thumbnail' => 'required',
                'deskripsi' => 'required',
            ]);
        } else {
            $rules = array_merge($rules, [
                'jenis_kompetisi' => 'required',
                'tingkat_kompetisi' => 'required',
                'tempat_kompetisi' => 'required',
                'tanggal_mulai' => 'required|date',
                'tanggal_akhir' => 'required|date',
                'jumlah_peserta' => 'required|numeric',
                'penghargaan' => 'required',
            ]);
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'category_id' => 'Kategori',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
            'min' => ':attribute setidaknya harus mempunyai panjang :min karakter',
            'file' => ':attribute harus berupa file gambar',
            'url' => ':attribute harus berupa url valid',
        ];
    }
}
