@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    <a href="{{ route('admin.master.team.show', compact('team')) }}" class="btn btn-default mb-2">
        Kembali
    </a>

    <div class="row">
        {!! $karya->detailHtml !!}
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
