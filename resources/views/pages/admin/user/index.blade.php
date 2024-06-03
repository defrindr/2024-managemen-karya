@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <a href="{{ route('admin.master.user.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> {{ __('Tambah data') }}
                    </a>
                </div>
                <div class="card-body">
                    <form action="" class="d-flex justify-content-end align-items-center gap-5" style="gap: 2rem">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari ...."
                                value="{{ old('search') ?? request()->get('search') ?? '' }}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Hak Akses</th>
                                    <th>Status</th>
                                    <th>Dibuat pada</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($items->count() === 0)
                                    <tr>
                                        <td colspan="3" class="text-center">Pengguna kosong</td>
                                    </tr>
                                @endif
                                @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            {{ ($items->currentpage() - 1) * $items->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->role->name }}</td>
                                        <td>{{ $item->statusLabel }}</td>
                                        <td>{{ indonesian_date($item->created_at) }}</td>
                                        <td>
                                            <a class=" btn btn-sm btn-warning mb-1 mr-1"
                                                href="{{ route('admin.master.user.edit', $item->id) }}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <form class="d-inline" action="{{ route('admin.master.user.destroy', $item) }}"
                                                onsubmit="return confirmDelete()" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" name="submit"
                                                    class="btn btn-sm btn-danger mb-1 mr-1"><i class="fa fa-trash"
                                                        aria-hidden="true"></i>
                                            </form>
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
    </div>
@endsection
@section('js')
    <script>
        const confirmDelete = () => {
            return confirm('Apakah anda yakin ingin menghapus data ini');
        };
    </script>
@endsection
