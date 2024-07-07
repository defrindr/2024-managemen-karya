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
            <td>Mata Kuliah</td>
            <td>:</td>
            <td>{!! $detail->mataKuliah->name !!}</td>
        </tr>
    </tbody>
</table>
<div style="text-align: justify">
    {!! $detail->deskripsi !!}
</div>
