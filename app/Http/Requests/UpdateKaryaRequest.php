<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Karya;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UpdateKaryaRequest extends FormRequest
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
        $id = request()->segment(3);
        if (Route::is('admin.master.team.karya.update')) {
            $id = request()->segment(5);
        }

        $karya = Karya::find($id);

        $rules = [];

        if ($karya->category_id == Category::KARYA_TUGAS) {
            $rules = array_merge($rules, [
                // 'thumbnail' => 'nullable|file|mimes:jpg,png,gif,jpeg',
                'judul' => 'required|min:5',
                'deskripsi' => 'required',
                'mata_kuliah_id' => 'required',
            ]);
        } else if ($karya->category_id == Category::KARYA_PROJECT) {
            $rules = array_merge($rules, [
                // 'thumbnail' => 'nullable|file|mimes:jpg,png,gif,jpeg',
                'judul' => 'required|min:5',
                'deskripsi' => 'required',
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
