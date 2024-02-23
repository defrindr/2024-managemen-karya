@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <form action="{{ route('admin.master.setting.update', $setting) }}" class="form" method="post"
                    enctype="multipart/form-data">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')

                        <img src="{{ $setting->bannerUrl }}" alt="" class="img img-fluid d-block m-auto"
                            style="max-width:200px;max-height:200px">
                        <div class="form-group">
                            <label for="input__banner">Banner</label>
                            <input id="input__banner" type="file" accept="image/*" class="form-control" name="banner">
                            @error('banner')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input__judul">Judul Website</label>
                            <input id="input__judul" type="text" class="form-control" name="judul"
                                value="{{ old('judul') ?? $setting->judul }}">
                            @error('judul')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input__deskripsi">Deskripsi</label>
                            <div id="editor"></div>
                            <input id="input__deskripsi" type="hidden" class="form-control" name="deskripsi">
                            @error('deskripsi')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input__informasi_kontak">Informasi Kontak</label>
                            <div id="editor2"></div>
                            <input id="input__informasi_kontak" type="hidden" class="form-control" name="informasi_kontak">
                            @error('informasi_kontak')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        @foreach ($socialMedia as $judul => $nilai)
                            <div class="form-group">
                                <label for="input__social_media">Sosial Media - {{ ucwords($judul) }}</label>
                                <input id="input__social_media" type="text" class="form-control"
                                    name="social_media[{{ $judul }}]" value="{{ $nilai }}">
                                @error('social_media.' . $judul)
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" id="submit">
                            <i class="fa fa-save"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
        }
    </style>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script>
        let editor;
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(newEditor => {
                editor = newEditor;
                editor.data.set(`{!! old('deskripsi') ?? $setting->deskripsi !!}`);
            })
            .catch(error => {
                console.error('ErrorBro', error);
            });

        let editor2;
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .then(newEditor => {
                editor2 = newEditor;
                editor2.data.set(`{!! old('informasi_kontak') ?? $setting->informasi_kontak !!}`);
            })
            .catch(error => {
                console.error('ErrorBro', error);
            });


        // Assuming there is a <button id="submit">Submit</button> in your application.
        document.querySelector('#submit').addEventListener('click', () => {
            $('#input__deskripsi').val(editor.getData());
            $('#input__informasi_kontak').val(editor2.getData());

            return confirm('Apakah anda yakin ingin menjalankan aksi ini ?')
        });
    </script>
@endsection
