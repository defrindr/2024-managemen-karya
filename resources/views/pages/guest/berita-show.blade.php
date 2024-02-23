@extends('layouts.app', compact('appName', 'socialMedias'))


@section('title', 'Beranda - ' . $appName)

@section('header')
    @include('layouts.app.header', compact('appName'))
    @include('layouts.app.hero-2')
@endsection

@section('content')
    <section id="about" class="about" style="padding:0 0 6rem">
        <div class="container">
            <div class="section-title" style="padding: 2rem;">
                <h3 class="detailtitle">{{ $berita->judul }}</h3>
                <p style="font-weight: normal;font-size: .8rem;color: #002a50">
                    {{ indonesian_date($berita->created_at) }}<br>
                    Administrator </p>
            </div>

            <div id="content">
                <div class="row">
                    <div class="col-md-12 text-center mb-4">
                        <img src="{{ $berita->imageUrl }}" alt="" class="img img-fluid d-block m-auto"
                            style="max-height: 450px;max-width:450px">
                        <div class="mb-3"></div>
                        <div class="text-left">
                            {!! $berita->konten !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
