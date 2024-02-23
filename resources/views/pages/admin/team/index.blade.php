@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    <div class="row">
        <div class="col-md-7 mb-2">
            <div class="card card-default">
                <div class="card-header">
                    <a href="{{ route('admin.master.team.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> {{ __('Buat Tim Baru') }}
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Tim</th>
                                    <th>Ketua</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($items->count() === 0)
                                    <tr>
                                        <td colspan="4" class="text-center">Anda belum mempunyai tim terdaftar</td>
                                    </tr>
                                @endif
                                @foreach ($items as $team)
                                    <tr>
                                        <td>
                                            {{ ($items->currentpage() - 1) * $items->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td>{{ $team->name }}</td>
                                        <td>{{ $team->leader->name }}</td>
                                        <td>
                                            <a class=" btn btn-sm btn-info mb-1 mr-1"
                                                href="{{ route('admin.master.team.show', $team->id) }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            @if ($team->isCreator())
                                                <a class=" btn btn-sm btn-warning mb-1 mr-1"
                                                    href="{{ route('admin.master.team.edit', $team->id) }}">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <form class="d-inline"
                                                    action="{{ route('admin.master.team.destroy', $team) }}"
                                                    onsubmit="return confirmDelete()" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" name="submit"
                                                        class="btn btn-sm btn-danger mb-1 mr-1"><i class="fa fa-trash"
                                                            aria-hidden="true"></i>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $items->links() }}
                </div>
            </div>
        </div>

        <div class="col-md-5 mb-2">
            <div class="card card-default">
                <div class="card-header">
                    <h2 class="text-bold">Pending Invitation</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Ketua</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($pendingInvitations) == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada pending invitation tersedia</td>
                                    </tr>
                                @endif
                                @foreach ($pendingInvitations as $team)
                                    <tr>
                                        <td>
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td>{{ $team->name }}</td>
                                        <td>{{ $team->leader->name }}</td>
                                        <td>
                                            <form class="d-inline" action="{{ route('admin.master.team.approve', $team) }}"
                                                onsubmit="return confirmApprove()" method="post">
                                                @csrf
                                                @method('post')
                                                <button type="submit" name="submit"
                                                    class="btn btn-sm btn-success mb-1 mr-1"><i class="fa fa-check"
                                                        aria-hidden="true"></i>
                                            </form>
                                            <form class="d-inline" action="{{ route('admin.master.team.reject', $team) }}"
                                                onsubmit="return confirmApprove()" method="post">
                                                @csrf
                                                @method('post')
                                                <button type="submit" name="submit"
                                                    class="btn btn-sm btn-danger mb-1 mr-1"><i class="fa fa-times"
                                                        aria-hidden="true"></i>
                                            </form>
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
