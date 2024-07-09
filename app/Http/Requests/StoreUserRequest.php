<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        $payload = [
            'username' => 'required|min:5',
            'name' => 'required',
            'role_id' => 'required',
            'password' => 'required|min:5',
            'status' => 'nullable'
        ];

        if (request()->has('role_id') && request()->get('role_id') == User::ROLE_MAHASISWA) {
            $payload['username'] = 'numeric|min:10';
        }

        return $payload;
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
            'min' => ':attribute setidaknya harus mempunyai panjang :min karakter',
            'file' => ':attribute harus berupa file gambar',
            'email' => ':attribute harus berupa email valid',
        ];
    }
}
