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
                    <div class="form-group">
                        <label for="input__category_id">Kategori</label>
                        <select name="category_id" id="input__category_id" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($category->id == old('category_id')) selected @endif>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div id="fields_container">
                    </div>
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
            let value = $('#input__category_id').val();

            if (!value) {
                alert('Kategori tidak boleh kosong')
                return;
            }

            if (confirm('Apakah anda yakin ingin menjalankan aksi ini ?')) {
                window.location.href = "{{ route('admin.master.karya-personal.create', 1337) }}"
                    .replace('1337', value)
            }
        });
    </script>
@endsection
