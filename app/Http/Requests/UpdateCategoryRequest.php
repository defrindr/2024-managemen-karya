<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        $categoryId = request()->segment(3);

        return [
            'gambar' => 'nullable|file|mimes:jpg,png,gif,jpeg',
            'name' => 'required|unique:categories,name,' . $categoryId,
        ];
    }
    public function attributes()
    {
        return ['icon' => 'Ikon', 'name' => 'Nama'];
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
