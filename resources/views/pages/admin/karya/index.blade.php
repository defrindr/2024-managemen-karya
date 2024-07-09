@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    {{-- <a href="{{ route('admin.master.karya.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> {{ __('Tambah Karya Personal') }}
                    </a> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Kontributor</th>
                                    <th>Status</th>
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
                                        <td>{{ $karya->Kontributor }}</td>
                                        <td>{{ $karya->status }}</td>
                                        <td>
                                            <a href="{{ route('admin.master.karya.show', compact('karya')) }}"
                                                class="btn btn-sm btn-info mb-1 mr-1">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @if (Auth::user()->role_id != \App\Models\User::ROLE_MAHASISWA)
                                                @if (!$karya->approved_by)
                                                    <form class="d-inline"
                                                        action="{{ route('admin.master.karya.approve', $karya) }}"
                                                        onsubmit="return confirmApprove()" method="post">
                                                        @csrf
                                                        @method('post')
                                                        <button type="submit" name="submit"
                                                            class="btn btn-sm btn-success mb-1 mr-1"><i class="fa fa-check"
                                                                aria-hidden="true"></i>
                                                    </form>
                                                @else
                                                    <form class="d-inline"
                                                        action="{{ route('admin.master.karya.reject', $karya) }}"
                                                        onsubmit="return confirmApprove()" method="post">
                                                        @csrf
                                                        @method('post')
                                                        <button type="submit" name="submit"
                                                            class="btn btn-sm btn-danger mb-1 mr-1"><i class="fa fa-times"
                                                                aria-hidden="true"></i>
                                                    </form>
                                                @endif
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
