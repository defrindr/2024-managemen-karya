@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <form action="{{ route('admin.master.berita.store') }}" class="form" method="post"
                    enctype="multipart/form-data">
                    <div class="card-header">
                        <a href="{{ route('admin.master.berita.index') }}" class="btn btn-default">
                            <i class="fa fa-chevron-left"></i> {{ __('Kembali') }}
                        </a>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="input__gambar">Gambar</label>
                            <input id="input__gambar" type="file" accept="image/*" class="form-control" name="gambar"
                                value="{{ old('gambar') }}">
                            @error('gambar')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="input__judul">Judul</label>
                            <input id="input__judul" type="text" class="form-control" name="judul"
                                value="{{ old('judul') }}">
                            @error('judul')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Konten</label>
                            <div id="editor"></div>
                            <input id="input__konten" type="hidden" class="form-control" name="konten">
                            @error('konten')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
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
                editor.data.set(`{!! old('konten') !!}`);

                $('.ck.ck-button.ck-off.ck-file-dialog-button').hide();
                $('.ck.ck-button.ck-off.ck-dropdown__button').hide();
            })
            .catch(error => {
                console.error('ErrorBro', error);
            });


        // Assuming there is a <button id="submit">Submit</button> in your application.
        document.querySelector('#submit').addEventListener('click', () => {
            $('#input__konten').val(editor.getData());

            return confirm('Apakah anda yakin ingin menjalankan aksi ini ?')
        });
    </script>
@endsection
