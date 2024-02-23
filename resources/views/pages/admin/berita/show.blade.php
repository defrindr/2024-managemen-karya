@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <a href="{{ route('admin.master.berita.index') }}" class="btn btn-default">
                        <i class="fa fa-chevron-left"></i> {{ __('Kembali') }}
                    </a>
                    <a class=" btn btn-warning mb-1 mr-1" href="{{ route('admin.master.berita.edit', $beritum->id) }}">
                        <i class="fa fa-pencil" aria-hidden="true"></i> Ubah Berita
                    </a>
                </div>
                <div class="card-body">
                    <h3>{{ $beritum->judul }}</h3>
                    <span>{{ indonesian_date($beritum->created_at) }}</span>
                    <img src="{{ $beritum->imageUrl }}" alt="{{ $beritum->judul }}" class="img img-fluid m-auto d-block"
                        style="max-width: 250px;max-height:250px;">
                    {!! $beritum->konten !!}
                </div>
            </div>
        </div>
    </div>
@endsection
