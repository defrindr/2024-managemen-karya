@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <a href="{{ route('admin.master.karya-personal.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> {{ __('Tambah Karya Personal') }}
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($items->count() === 0)
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada karya</td>
                                    </tr>
                                @endif
                                @foreach ($items as $karya)
                                    <tr>
                                        <td>
                                            {{ ($items->currentpage() - 1) * $items->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td>{{ $karya->judul }}</td>
                                        <td>
                                            <a href="{{ route('admin.master.karya-personal.edit', ['karya_personal' => $karya]) }}"
                                                class="btn btn-sm btn-warning mb-1 mr-1">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="{{ route('admin.master.karya-personal.show', ['karya_personal' => $karya]) }}"
                                                class="btn btn-sm btn-info mb-1 mr-1">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            @if ($karya->created_by === auth()->user()->id)
                                                <form class="d-inline"
                                                    action="{{ route('admin.master.karya-personal.destroy', ['karya_personal' => $karya]) }}"
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
        const confirmApprove = () => {
            return confirm('Apakah anda yakin menyetujui karya ini');
        };
    </script>
@endsection
