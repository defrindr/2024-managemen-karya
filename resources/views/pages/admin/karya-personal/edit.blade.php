@extends('layouts.admin.main')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <form action="{{ route('admin.master.karya-personal.update', ['karya_personal' => $karya]) }}" class="form"
                    method="post" enctype="multipart/form-data">
                    <div class="card-header">
                        <a href="{{ url()->previous() }}" class="btn btn-default">
                            <i class="fa fa-chevron-left"></i> {{ __('Kembali') }}
                        </a>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')

                        {!! $templateInput !!}
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
    {!! $templateScript !!}
@endsection
