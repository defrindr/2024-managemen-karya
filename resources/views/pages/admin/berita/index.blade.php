@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <a href="{{ route('admin.master.berita.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> {{ __('Tambah data') }}
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Thumbnail</th>
                                    <th>Judul</th>
                                    <th>Dibuat pada</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($items->count() === 0)
                                    <tr>
                                        <td colspan="3" class="text-center">Berita kosong</td>
                                    </tr>
                                @endif
                                @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            {{ ($items->currentpage() - 1) * $items->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td>
                                            <a href="{{ $item->imageUrl }}" target="_blank">
                                                <img src="{{ $item->imageUrl }}" alt="{{ $item->judul }}"
                                                    class="img img-fluid" style="max-width:100px;max-height:100px">
                                            </a>
                                        </td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ indonesian_date($item->created_at) }}</td>
                                        <td>
                                            <a class=" btn btn-sm btn-warning mb-1 mr-1"
                                                href="{{ route('admin.master.berita.edit', $item->id) }}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <form class="d-inline"
                                                action="{{ route('admin.master.berita.destroy', $item) }}"
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
