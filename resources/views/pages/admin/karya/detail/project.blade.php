<div class="col-md-12 mb-2">
    <div class="card card-default p-3">
        <div class="card-header">
            <h3 class="text-bold">{{ $karya->judul }}</h3>
            <p class="text-small">Oleh {{ $karya->kontributor }}</p>
        </div>
        <div class="card-body">

            <table class="table table-hover table-striped">
                <tbody>
                    <tr>
                        <td>Judul</td>
                        <td>{{ $karya->judul }}</td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>{{ $karya->category->name }}</td>
                    </tr>
                    @if ($karya->is_personal)
                        <tr>
                            <td>Personal</td>
                            <td>{{ $karya->is_personal ? 'Ya' : 'Tidak' }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>Youtube</td>
                        <td>{!! $karya->youtubeAnchor !!}</td>
                    </tr>
                    <tr>
                        <td>Project</td>
                        <td>{!! $karya->projectAnchor !!}</td>
                    </tr>
                    <tr>
                        <td>Gambar</td>
                        <td>
                            <a href="{{ $karya->thumbnailUrl }}" target="_blank">
                                <img src="{{ $karya->thumbnailUrl }}" alt="" class="img img-fluid"
                                    style="max-width: 120px">
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            {!! $detail->deskripsi !!}
        </div>
    </div>
</div>
