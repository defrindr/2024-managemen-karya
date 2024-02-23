@extends('layouts.app', compact('appName', 'socialMedias'))


@section('title', 'Beranda - ' . $appName)

@section('header')
    @include('layouts.app.header', compact('appName'))
    @include('layouts.app.hero-2')
@endsection

@section('content')
    <section id="about" class="about" style="padding:0 0 6rem">
        <div class="container">
            <div class="section-title team">
                <h3> Berita</h3>
                <p>Daftar berita</p>
            </div>
            <div class="mb-3"></div>
            <div id="content">
                <div class="row">
                    @foreach ($listBerita as $berita)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <a href="{{ route('berita.detail', compact('berita')) }}">
                                <div class="box box-default">
                                    <div class="box-image"
                                        style="background-image: url({{ $berita->imageUrl }}); background-size:cover;background-color: #ccc">
                                    </div>
                                    <div class="box-info">
                                        <span class="title">{{ $berita->judul }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            {{ $listBerita->links() }}
        </div>
    </section>
@endsection
