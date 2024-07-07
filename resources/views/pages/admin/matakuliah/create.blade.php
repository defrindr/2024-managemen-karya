@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <form action="{{ route('admin.master.matakuliah.store') }}" class="form" method="post"
                    enctype="multipart/form-data">
                    <div class="card-header">
                        <a href="{{ route('admin.master.matakuliah.index') }}" class="btn btn-default">
                            <i class="fa fa-chevron-left"></i> {{ __('Kembali') }}
                        </a>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="input__name">Nama Mata Kuliah</label>
                            <input id="input__name" type="text" class="form-control" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary"
                            onclick="return confirm('Apakah anda yakin ingin menjalankan aksi ini ?')">
                            <i class="fa fa-save"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
