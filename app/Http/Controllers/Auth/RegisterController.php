<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{

    public function showRegistrationForm()
    {
        return view("auth.register");
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|numeric',
            'name' => 'required',
            'password' => 'required'
        ]);

        $payload = $request->only(['username', 'name', 'password']);
        $payload['role_id'] = User::ROLE_MAHASISWA;

        if ($user = User::create($payload)) {
            // auth()->login($user);
            return Redirect::route('admin.home');
        }

        return Redirect::back();
    }
}
