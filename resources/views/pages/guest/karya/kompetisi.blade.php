<table class="table table-borderless text-left" style="font-size: .8rem;color:#aaa">
    <tbody>
        <tr>
            <td>Kategori</td>
            <td>:</td>
            <td>{{ $karya->category->name }}</td>
        </tr>
        @if (!$karya->is_personal)
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
        @else
            <tr>
                <td>Nama Peserta</td>
                <td>:</td>
                <td>{!! $karya->createdBy->name !!}</td>
            </tr>
        @endif
        <tr>
            <td>Jenis Kompetisi</td>
            <td>:</td>
            <td>{{ $detail->jenisKompetisi->name }}</td>
        </tr>
        <tr>
            <td>Tempat Kompetisi</td>
            <td>:</td>
            <td>{{ $detail->tempat_kompetisi }}</td>
        </tr>
        <tr>
            <td>Tanggal Kompetisi</td>
            <td>:</td>
            <td>{{ indonesian_date($detail->tanggal_mulai) . ' s/d ' . indonesian_date($detail->tanggal_akhir) }}
            </td>
        </tr>
        <tr>
            <td>Penghargaan</td>
            <td>:</td>
            <td>{{ $detail->penghargaan }}</td>
        </tr>
        @if ($karya->youtube_url != '-')
            <tr>
                <td>Youtube</td>
                <td>:</td>
                <td>
                    <a href="{!! $karya->youtube_url !!}" target="_blank">
                        Kunjungi
                    </a>
                </td>
            </tr>
        @endif

        @if ($karya->project_url != '-')
            <tr>
                <td>Project</td>
                <td>:</td>
                <td>
                    <a href="{!! $karya->project_url !!}" target="_blank">
                        Kunjungi
                    </a>
                </td>
            </tr>
        @endif
    </tbody>
</table>

<h4>Peserta</h4>

@if (count($pesertas) == 0)
    <p>Tidak ada foto peserta</p>
@endif
<div class="row">
    @foreach ($pesertas as $peserta)
        <div class="col-md-3">
            <a href="{{ $peserta->fileUrl }}" target="_blank" style="display: inline-block">
                <img src="{{ $peserta->fileUrl }}" alt="" class="img img-fluid">
                <span>{{ $peserta->keterangan }}</span>
            </a>
        </div>
    @endforeach
</div>

<h4>Kegiatan</h4>

@if (count($kegiatans) == 0)
    <p>Tidak ada foto kegiatan</p>
@endif
<div class="row">
    @foreach ($kegiatans as $kegiatan)
        <div class="col-md-3">
            <a href="{{ $kegiatan->fileUrl }}" target="_blank" style="display: inline-block">
                <img src="{{ $kegiatan->fileUrl }}" alt="" class="img img-fluid">
                <span>{{ $kegiatan->keterangan }}</span>
            </a>
        </div>
    @endforeach
</div>

<h4>Poster</h4>

@if (count($posters) == 0)
    <p>Tidak ada foto poster</p>
@endif
<div class="row">
    @foreach ($posters as $poster)
        <div class="col-md-3">
            <a href="{{ $poster->fileUrl }}" target="_blank" style="display: inline-block">
                <img src="{{ $poster->fileUrl }}" alt="" class="img img-fluid">
                <span>{{ $poster->keterangan }}</span>
            </a>
        </div>
    @endforeach
</div>
