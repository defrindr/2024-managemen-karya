@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <form action="{{ route('admin.master.team.karya.update', compact('team', 'karya')) }}" class="form" method="post"
                    enctype="multipart/form-data">
                    <div class="card-header">
                        <a href="{{ url()->previous() }}" class="btn btn-default">
                            <i class="fa fa-chevron-left"></i> {{ __('Kembali') }}
                        </a>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="input__category_id">Kategori</label>
                            <select name="category_id" id="input__category_id" class="form-control">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id === (old('category_id') ?? $karya->category_id)) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="input__gambar">Gambar</label>
                            <input id="input__gambar" type="file" class="form-control" name="gambar" accept="image/*">
                            @error('gambar')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="input__judul">Judul Karya</label>
                            <input id="input__judul" type="text" class="form-control" name="judul"
                                value="{{ old('judul') ?? $karya->judul }}">
                            @error('judul')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="input__link_youtube">Link Youtube</label>
                            <input id="input__link_youtube" type="text" class="form-control" name="link_youtube"
                                placeholder="http://" value="{{ old('link_youtube') ?? $karya->link_youtube }}">
                            @error('link_youtube')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <div id="editor"></div>
                            <input id="input__deskripsi" type="hidden" class="form-control" name="deskripsi" />
                            @error('deskripsi')
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
                editor.data.set(`{!! $karya->deskripsi !!}`);
            })
            .catch(error => {
                console.error('ErrorBro', error);
            });


        // Assuming there is a <button id="submit">Submit</button> in your application.
        document.querySelector('#submit').addEventListener('click', () => {
            $('#input__deskripsi').val(editor.getData());

            return confirm('Apakah anda yakin ingin menjalankan aksi ini ?')
        });
    </script>
@endsection
