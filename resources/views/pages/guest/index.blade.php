@extends('layouts.app', compact('appName', 'socialMedias'))

@section('title', 'Beranda - ' . $appName)

@section('header')
    @include('layouts.app.header', compact('appName'))
    @include('layouts.app.hero', compact('appName'))
@endsection

@section('css')
    <style>
        :root {
            --color-primary: #0F2C56;
            --color-white: #FFFFFF;
            --color-accent: #e43c5c
        }

        /* section */
        section {
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .section-title {
            text-align: center;
            padding-bottom: 30px;
        }

        .section-title h3 {
            margin: 15px 0 0 0;
            font-size: 32px;
            font-weight: 700;
            color: var(--color-primary);
        }

        .section-title h3 span {
            color: var(--color-accent);
        }

        /* category */
        section#categories {
            padding-top: 60px;
        }

        .category {
            transition: 1s;
            margin-bottom: 1rem;
            padding: 1rem;
            border-radius: 1rem;
        }

        .category:hover {
            background: var(--color-primary);
        }

        .category .category-icon {
            max-width: 5rem;
            margin: auto;
            display: block;
            margin-bottom: .5rem
        }

        .category .category-title {
            display: block;
            text-transform: capitalize;
            font-weight: bold;
            font-size: 14px;
            text-align: center
        }

        .category:hover {
            background: var(--color-primary);
            color: var(--color-white);
        }

        .category:hover .category-icon {
            /* filter: brightness(0) invert(1); */
        }

        .category:hover .category-title {
            color: var(--color-white);
        }

        #hero {
            background: url('{!! $appBanner !!}');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endsection

@section('content')

    <section id="categories">
        <div class="container-fluid">
            <div class="row justify-content-center">
                @foreach ($listKategori as $kategori)
                    <div class="col-md-3">
                        <div class="category">
                            <img src="{{ $kategori->getIconPath() }}" alt="{{ $kategori->name }}"
                                class="img img-fluid category-icon">
                            <span class="category-title">
                                {{ $kategori->name }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="portfolio" class="portfolio">
        <div class="container">
            <div class="row">
                <div
                    class="col-lg-12 d-flex justify-content-lg-between justify-content-center align-middle flex-lg-row flex-column">
                    <div class="section-title">
                        <h3>Karya <span>Terbaru</span></h3>
                    </div>
                    <div style="overflow-x: auto;">
                        <div class="d-flex flex-row m-auto m-lg-0">
                            <ul id="portfolio-flters">
                                <li data-filter="*" class="filter-active">Semua</li>
                                <?php foreach ($filterKarya as $filter) : ?>
                                <li data-filter=".filter-{{ $filter->slug }}">{{ $filter->name }}</li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row portfolio-container">
                @foreach ($listKarya as $karya)
                    <div class="col-md-4 col-sm-6 portfolio-item filter-{{ $karya->category->slug }}">
                        <a href="{{ route('karya.detail', $karya) }}">
                            <div class="text-center flex-1" style="height:210px">
                                <img src="{!! $karya->imageUrl !!}" class="img img-fluid" alt="{{ $karya->judul }}">
                                <div class="portfolio-info">
                                    <h4>{{ $karya->judul }}</h4>
                                    <p>{{ $karya->summary }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="about" class="about bg-grey">
        <div class="container">
            <div class="row flex-lg-row-reverse">
                <div class="col-lg-12 col-md-12">
                    <div class="about-title">
                        <h3>Tentang <span>{{ $appName }}</span></h3>
                    </div>
                    <div class="about-content">
                        <p>{!! $appDescription !!}</p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section id="news">
        <div class="container">
            <div class="section-title text-left" style="display: flex;justify-content:space-between">
                <h3 style="display:inline-block">Berita <span>Terbaru</span></h3>
                <div style="vertical-align: middle;display: flex;flex-direction: column-reverse;">
                    <a href="/app/berita" class="btn btn-primary">Lebih Banyak</a>
                </div>
            </div>
            <div class="row">
                @foreach ($listBerita as $berita)
                    <div class="col-lg-4 col-md-4 col-md-6 col-sm-12 mb-3">
                        <div class="card" style="border-radius: 1.2rem;overflow:hidden">
                            <img class="card-img-top" src="{!! $berita->imageUrl !!}" alt="Image" style="height: 200px;">
                            <div class="card-body">
                                <span
                                    style="font-size: .7rem;color:#aeaeae">{{ indonesian_date($berita->created_at) }}</span>
                                <h5 class="card-title">{{ $berita->judul }}</h5>
                                <p class="card-text">{{ $berita->summary }}</p>
                                <a href="{{ route('berita.detail', compact('berita')) }}"
                                    class="btn btn-primary blue">Lainnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
