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
                        <td>Kategori</td>
                        <td>{{ $karya->category->name }}</td>
                    </tr>
                    <tr>
                        <td>Mata Kuliah</td>
                        <td>{{ $detail->mataKuliah->name }}</td>
                    </tr>
                    <tr>
                        <td>Judul</td>
                        <td>{{ $karya->judul }}</td>
                    </tr>
                    @if ($karya->is_personal)
                        <tr>
                            <td>Personal</td>
                            <td>{{ $karya->is_personal ? 'Ya' : 'Tidak' }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <hr>
            {!! $detail->deskripsi !!}

        </div>
    </div>
</div>
