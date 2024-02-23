@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    <a href="{{ route('admin.master.team.show', compact('team')) }}" class="btn btn-default mb-2">
        Kembali
    </a>

    <div class="row">
        <div class="col-md-9 mb-2">
            <div class="card card-default p-3">
                <div class="card-header">
                    <h3 class="text-bold">{{ $karya->judul }}</h3>
                    <p class="text-small">Oleh Kelompok {{ $team->name }}</p>
                </div>
                <div class="card-body">
                    <img src="{{ asset('karya/' . $karya->gambar) }}" alt="" class="img img-fluid m-auto d-block"
                        style="max-width: 200px">
                    <p>
                        {!! $karya->deskripsi !!}
                    </p>
                    <p class="text-bold">Tautan youtube : </p>
                    <a href="{{ $karya->link_youtube }}" target="_blank">{{ $karya->link_youtube }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="card card-default p-3">
                <div class="card-header">
                    <h4>Anggota Kelompok</h4>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach ($team->members as $member)
                            <li>{{ $member->name }}</li>
                        @endforeach
                    </ul>
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
