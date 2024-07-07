@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <a href="{{ url()->previous() }}" class="btn btn-default">
                        <i class="fa fa-chevron-left"></i> {{ __('Kembali') }}
                    </a>
                </div>
                <div class="card-body">
                    <form id="form" method="POST"
                        action="{{ route('admin.master.karya.asset.store', compact('karya', 'redirect')) }}"
                        enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="input__tipe">Tipe</label>
                            <select name="tipe" id="input__tipe" class="form-control">
                                <option value="">Pilih Tipe</option>
                                <option value="poster">Poster</option>
                                <option value="kegiatan">Kegiatan</option>
                                <option value="peserta">Peserta</option>
                            </select>
                            @error('tipe')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input__file">File</label>
                            <input type="file" class="form-control" id="input__file" name="file" accept="image/*">
                            @error('file')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input__keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="input__keterangan" name="keterangan">
                            @error('keterangan')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" id="submit">
                        Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        // Assuming there is a <button id="submit">Submit</button> in your application.
        document.querySelector('#submit').addEventListener('click', () => {
            if (confirm('Apakah anda yakin ingin menjalankan aksi ini ?')) {
                document.querySelector('#form').submit();
            }
        });
    </script>
@endsection
