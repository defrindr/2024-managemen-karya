@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <form action="{{ route('admin.master.user.store') }}" class="form" method="post"
                    enctype="multipart/form-data">
                    <div class="card-header">
                        <a href="{{ route('admin.master.user.index') }}" class="btn btn-default">
                            <i class="fa fa-chevron-left"></i> {{ __('Kembali') }}
                        </a>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="input__name">Name</label>
                            <input id="input__name" type="text" class="form-control" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="input__username">Username / NIM</label>
                            <input id="input__username" type="text" class="form-control" name="username"
                                value="{{ old('username') }}">
                            @error('username')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="input__password">Password</label>
                            <input id="input__password" type="password" class="form-control" name="password">
                            @error('password')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="input__role_id">Hak Akses</label>
                            <select name="role_id" id="input__role_id" class="form-control">
                                @foreach ($roles as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == old('role_id') ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="input__password">Status</label>
                            <div>
                                <input type="radio" name="status" id="" value="0"
                                    @if (old('status') === 0) checked @endif>
                                Tidak Aktif
                            </div>
                            <div>
                                <input type="radio" name="status" id=""
                                    value="1"@if (old('status') === 1 || old('status') === null) checked @endif>
                                Aktif
                            </div>
                            @error('status')
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
