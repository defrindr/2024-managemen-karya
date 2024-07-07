@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    <a href="{{ route('admin.master.team.index') }}" class="btn btn-default mb-2">
        Kembali
    </a>

    <div class="row">
        <div class="col-md-4 mb-2">
            <div class="card card-default">
                <div class="card-header">
                    <h4 class="d-inline">Daftar Anggota</h4>
                    @if ($team->isCreator())
                        <a href="{{ route('admin.master.team.member.create', compact('team')) }}"
                            class="btn btn-primary float-right">
                            <i class="fa fa-plus"></i>
                            Tambah Baru
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    @if ($team->isCreator())
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $member)
                                    <tr>
                                        <td>
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->pivot->approve ? 'Approve' : 'Pending' }}</td>
                                        @if ($team->isCreator())
                                            <td>
                                                @if ($team->created_by !== $member->id)
                                                    <form class="d-inline"
                                                        action="{{ route('admin.master.team.member.destroy', compact('team', 'member')) }}"
                                                        onsubmit="return confirmDelete()" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" name="submit"
                                                            class="btn btn-sm btn-danger mb-1 mr-1"><i class="fa fa-trash"
                                                                aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-2">
            <div class="card card-default">
                <div class="card-header">
                    <h4 class="d-inline-block">Daftar Karya Tim</h4>
                    <a href="{{ route('admin.master.team.karya.create', compact('team')) }}"
                        class="btn btn-primary float-right">
                        <i class="fa fa-plus"></i>
                        Tambah Baru
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Penginput</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listKaryaTim as $karya)
                                    <tr>
                                        <td>
                                            {{ ($listKaryaTim->currentpage() - 1) * $listKaryaTim->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td>{{ $karya->judul }}</td>
                                        <td>{{ $karya->createdBy->name }}</td>
                                        <td>{{ $karya->status }}</td>
                                        <td>
                                            <a href="{{ route('admin.master.team.karya.show', compact('team', 'karya')) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.master.team.karya.edit', compact('team', 'karya')) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            @if ($karya->created_by === auth()->user()->id || $team->isCreator())
                                                <form class="d-inline"
                                                    action="{{ route('admin.master.team.karya.destroy', compact('team', 'karya')) }}"
                                                    onsubmit="return confirmDelete()" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" name="submit"
                                                        class="btn btn-sm btn-danger mb-1 mr-1"><i class="fa fa-trash"
                                                            aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script>
        const confirmDelete = () => {
            return confirm('Apakah anda yakin ingin menghapus data ini');
        };
        const confirmApprove = () => {
            return confirm('Apakah anda yakin ingin menyetujui invitasi tim ini');
        };
    </script>
@endsection
