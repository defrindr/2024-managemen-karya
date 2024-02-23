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
                <h3 class="detailtitle">{{ $karya->judul }}</h3>
                <p style="font-weight: normal;font-size: .8rem;color: #002a50">
                    {{ indonesian_date($karya->created_at) }}
                </p>
            </div>

            <div id="content">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <a href="{{ $karya->imageUrl }}" target="_blank">
                            <img src="{{ $karya->imageUrl }}" alt="{{ $karya->judul }}" class="img img-fluid"
                                style="max-width: 350px; max-height:350px;display:block;margin:auto">
                        </a>
                    </div>
                    <div class="col-md-9 mb-2">
                        <table class="table table-borderless text-left" style="font-size: .8rem;color:#aaa">
                            <tbody>
                                <tr>
                                    <td>Nama Tim</td>
                                    <td>:</td>
                                    <td>{{ $karya->team->name }}</td>
                                </tr>
                                <tr>
                                    <td>Anggota</td>
                                    <td>:</td>
                                    <td>{!! $karya->team->memberText !!}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="text-align: justify">
                            {!! $karya->deskripsi !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
