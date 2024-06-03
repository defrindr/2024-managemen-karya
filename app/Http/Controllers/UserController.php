<?php

namespace App\Http\Controllers;

use App\Helpers\RequestHelper;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Pengguna';
        $items = User::query()->orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $search = $request->get('search');
            $items->join('roles', 'roles.id', 'users.role_id')->where(function ($q) use ($search) {
                $q->where('users.name', 'like', "%$search%")
                    ->orWhere('users.username', 'like', "%$search%")
                    ->orWhere('roles.name', 'like', "%$search%");
            })->select('users.*');
        }

        $items = $items->orderBy('id', 'desc')->paginate(10);

        return view('pages.admin.user.index', compact('title', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Pengguna';
        $roles = Role::all();

        return view('pages.admin.user.create', compact('title', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $payload = $request->validated();

        try {
            $user = User::create($payload);
            session()->flash('success', 'Pengguna berhasil ditambahkan');

            return Redirect::route('admin.master.user.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan ketika menambahkan Pengguna' . $th->getMessage());

            return Redirect::route('admin.master.user.create')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = 'Ubah Pengguna';
        $roles = Role::all();

        return view('pages.admin.user.edit', compact('title', 'user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $payload = $request->validated();

        if (isset($payload['password']) && !$payload['password']) {
            unset($payload['password']);
        }

        try {
            $user->update($payload);
            session()->flash('success', 'Pengguna berhasil diubah');

            return Redirect::route('admin.master.user.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan ketika mengubah Pengguna' . $th->getMessage());

            return Redirect::route('admin.master.user.edit', compact('user'))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        try {
            $user->delete();
            session()->flash('success', 'Pengguna berhasil dihapus');

            return Redirect::route('admin.master.user.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan ketika menghapus Pengguna' . $th->getMessage());

            return Redirect::back();
        }
    }
}
