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
                <h3>Karya</h3>
                <p>Daftar Karya dari Mahasiswa</p>
            </div>

            <div class="d-flex category_faq text-center justify-content-center">
                <a href="{{ route('karya') }}" class="selected">Semua</a>
                @foreach ($listKategori as $kategori)
                    <a href="{{ route('karya', ['kategori' => $kategori->id]) }}">{{ $kategori->name }}</a>
                @endforeach
            </div>

            <div id="content">

                <div class="row">
                    @foreach ($listKarya as $item)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <a href="{{ route('karya.detail', $item) }}">
                                <div class="box box-default">
                                    <div class="box-image hover-cover"
                                        style="background-image: url({{ $item->gambarUrl }}); background-size:contain;background-repeat:no-repeat;background-color: #fff;transition: 1s;background-position: center">
                                    </div>
                                    <div class="box-info">
                                        <span class="title">{{ $item->judul }}</span>
                                        <span class="category">{{ $item->category->name }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                {!! $listKarya->withQueryString()->links() !!}
            </div>
        </div>
    </section>
@endsection
