<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamDetailRequest;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Karya;
use App\Models\Team;
use App\Models\TeamDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $title = 'Daftar Tim Saya';
        $items = Team::orderBy('name', 'asc')->userInvitations($userId, true)->paginate();
        $pendingInvitations = Team::userInvitations($userId, false)->get();

        return view('pages.admin.team.index', compact('title', 'items', 'pendingInvitations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Tim Baru';

        return view('pages.admin.team.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        try {
            DB::beginTransaction();
            $payload = $request->validated();
            $payload['created_by'] = auth()->user()->id;
            $team = Team::create($payload);
            TeamDetail::create(['team_id' => $team->id, 'user_id' => $payload['created_by'], 'approve' => true]);
            DB::commit();

            session()->flash('success', 'Berhasil membuat tim baru!');

            return Redirect::route('admin.master.team.show', $team);
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Gagal membuat tim!');

            return Redirect::route('admin.master.team.create')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        $title = "Edit Tim '{$team->name}'";
        $listKaryaTim = Karya::where('team_id', $team->id)->paginate();
        $members = $team->members()->get();

        return view('pages.admin.team.show', compact('title', 'team', 'listKaryaTim', 'members'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        $title = 'Ubah Tim';

        return view('pages.admin.team.edit', compact('title', 'team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        try {
            $team->update($request->validated());

            session()->flash('success', 'Berhasil mengubah tim!');

            return Redirect::route('admin.master.team.show', $team);
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal mengubah tim!');

            return Redirect::route('admin.master.team.edit', $team)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        try {
            $team->delete();

            session()->flash('success', 'Berhasil menghapus tim!');

            return Redirect::route('admin.master.team.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal menghapus tim!');

            return Redirect::route('admin.master.team.index');
        }
    }

    public function approve(Team $team)
    {
        try {
            $user = auth()->user();
            $member = TeamDetail::where(['team_id' => $team->id, 'user_id' => $user->id])->first();
            if (! $member) {
                session()->flash('error', 'Anda tidak terdaftar dalam tim!');

                return Redirect::route('admin.master.team.index');
            } elseif ($member->approve) {
                session()->flash('error', 'Anda telah terdaftar dalam tim!');

                return Redirect::route('admin.master.team.index');
            }

            $member->update(['approve' => true]);

            session()->flash('success', 'Berhasil bergabung dengan tim!');

            return Redirect::route('admin.master.team.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal bergabung dengan tim!');

            return Redirect::route('admin.master.team.index');
        }
    }

    public function reject(Team $team)
    {
        try {
            $user = auth()->user();
            $member = TeamDetail::where(['team_id' => $team->id, 'user_id' => $user->id])->first();
            if (! $member) {
                session()->flash('error', 'Anda tidak di invite ke tim!');

                return Redirect::route('admin.master.team.index');
            } elseif ($member->approve) {
                session()->flash('error', 'Anda telah terdaftar dalam tim!');

                return Redirect::route('admin.master.team.index');
            }

            $member->delete();

            session()->flash('success', 'Berhasil menolak bergabung dengan tim!');

            return Redirect::route('admin.master.team.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal menolak bergabung dengan tim!');

            return Redirect::route('admin.master.team.index');
        }
    }

    public function createMember(Team $team)
    {
        $title = 'Tambahkan anggota baru';

        return view('pages.admin.team.member.create', compact('title', 'team'));
    }

    public function cariPengguna(Request $request)
    {
        $validator = Validator::make($request->all(), ['username' => 'required']);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Masukkan kata kunci pencarian']);
        }

        $user = User::where('username', $request->username)->first();
        if (! $user) {
            return response()->json(['status' => false, 'message' => 'Pengguna tidak terdaftar']);
        }

        return response()->json(['status' => true, 'data' => $user, 'message' => 'Pengguna berhasil ditemukan']);
    }

    public function storeMember(StoreTeamDetailRequest $request, Team $team)
    {
        try {
            $payload = $request->validated();
            $payload['team_id'] = $team->id;

            $exist = TeamDetail::where($payload)->first();
            if ($exist) {
                session()->flash('error', 'Anggota telah ditambahkan sebelumnya!');

                return Redirect::route('admin.master.team.member.create', $team);
            }

            TeamDetail::create($payload);

            session()->flash('success', 'Berhasil menambahkan anggota tim!');

            return Redirect::route('admin.master.team.show', $team);
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal menambahkan anggota tim!');

            return Redirect::route('admin.master.team.member.create', $team);
        }
    }

    public function destroyMember(Team $team, User $member)
    {
        if ($member->id == $team->created_by) {
            session()->flash('error', 'Ketua tidak dapat dihapus dari tim!');

            return Redirect::route('admin.master.team.show', $team);
        }

        $teamMember = TeamDetail::where('team_id', $team->id)->where('user_id', $member->id)->first();
        if (! $teamMember) {
            session()->flash('error', 'Anggota tidak ditemukan di tim ini!');

            return Redirect::route('admin.master.team.show', $team);
        }

        try {
            $teamMember->delete();

            session()->flash('success', 'Berhasil menghapus anggota dari tim!');

            return Redirect::route('admin.master.team.show', $team);
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal menghapus anggota dari tim!');

            return Redirect::route('admin.master.team.show', $team);
        }
    }
}
