<?php

namespace App\Http\Controllers;

use App\Models\Karya;
use App\Models\Team;
use App\Models\TeamDetail;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class KaryaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Daftar Karya';

        $queryBuilder = Karya::query();

        $queryBuilder->orderBy('created_at', 'desc');

        $user = auth()->user();
        $userId = $user->id;
        $roleId = $user->role_id;

        if ($roleId === User::ROLE_MAHASISWA) {
            $queryBuilder = $queryBuilder->whereIn('team_id', TeamDetail::where('approve', true)->where('user_id', $userId)->select('team_id'));
        }

        $items = $queryBuilder->paginate();

        return view('pages.admin.karya.index', compact('items', 'title'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team, Karya $karya)
    {
        $title = 'Detail Karya';

        return view('pages.admin.karya.show', compact('karya', 'title'));
    }

    public function approve(Karya $karya)
    {
        try {
            $user = auth()->user();
            if ($user->role_id == User::ROLE_MAHASISWA) {
                session()->flash('error', 'Anda tidak memiliki hak akses ini!');

                return Redirect::route('admin.master.karya.index');
            } elseif ($karya->approve) {
                session()->flash('error', 'Karya ini telah di approve!');

                return Redirect::route('admin.master.karya.index');
            }

            $karya->update(['approved_by' => $user->id]);

            session()->flash('success', 'Berhasil melakukan approving terhadap karya!');

            return Redirect::route('admin.master.karya.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal melakukan approving terhadap karya!' . $th->getMessage());

            return Redirect::route('admin.master.karya.index');
        }
    }

    public function reject(Karya $karya)
    {
        try {
            $user = auth()->user();
            if ($user->role_id == User::ROLE_MAHASISWA) {
                session()->flash('error', 'Anda tidak memiliki hak akses ini!');

                return Redirect::route('admin.master.karya.index');
            } elseif (!$karya->approved_by) {
                session()->flash('error', 'Karya ini belum di approve!');

                return Redirect::route('admin.master.karya.index');
            } elseif ($karya->approved_by != $user->id) {
                session()->flash('error', 'Hanya orang yang melakukan approving yang dapat mengubah status karya ini lagi!');

                return Redirect::route('admin.master.karya.index');
            }

            $karya->update(['approved_by' => null]);

            session()->flash('success', 'Status karya berhasil di ubah!');

            return Redirect::route('admin.master.karya.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal mengubah status dari karya terkait!');

            return Redirect::route('admin.master.karya.index');
        }
    }
}
