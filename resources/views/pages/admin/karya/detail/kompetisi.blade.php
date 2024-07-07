@if ($karya->is_personal)
    <div class="col-md-12 mb-2">
    @else
        <div class="col-md-9 mb-2">
@endif
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
                    <td>Judul</td>
                    <td>{{ $karya->judul }}</td>
                </tr>
                @if ($karya->is_personal)
                    <tr>
                        <td>Personal</td>
                        <td>{{ $karya->is_personal ? 'Ya' : 'Tidak' }}</td>
                    </tr>
                @else
                    <tr>
                        <td>Nama Tim</td>
                        <td>{{ $karya->team->name }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Peserta</td>
                        <td>{{ $detail->jumlah_peserta }}</td>
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
                <tr>
                    <td>Jenis Kompetisi</td>
                    <td>{{ $detail->jenis_kompetisi }}</td>
                </tr>
                <tr>
                    <td>Tempat Kompetisi</td>
                    <td>{{ $detail->tempat_kompetisi }}</td>
                </tr>
                <tr>
                    <td>Tanggal Kompetisi</td>
                    <td>{{ indonesian_date($detail->tanggal_mulai) . ' s/d ' . indonesian_date($detail->tanggal_akhir) }}
                    </td>
                </tr>
                <tr>
                    <td>Penghargaan</td>
                    <td>{{ $detail->penghargaan }}</td>
                </tr>
            </tbody>
        </table>
        <hr>
        {!! $detail->deskripsi !!}
    </div>
</div>
</div>
@if (!$karya->is_personal)
    <div class="col-md-3 mb-2">
        <div class="card card-default p-3">
            <div class="card-header">
                <h4>Anggota Kelompok</h4>
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($karya->team->members as $member)
                        <li>{{ $member->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<div class="col-md-12 mb-3">
    <div class="card card-info">
        <div class="card-header">
            <h3>Aset Karya</h3>
        </div>
        <div class="card-body">
            @if ($karya->isCreator())
                <a href="{{ route('admin.master.karya.asset.create', [
                    'karya' => $karya,
                    'redirect' => request()->url(),
                ]) }}"
                    class="btn btn-primary mb-4">
                    <i class="fa fa-plus"></i> Tambah
                </a>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipe</th>
                            <th>Keterangan</th>
                            <th>File</th>
                            @if ($karya->isCreator())
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($assets->count() === 0)
                            <tr>
                                <td colspan="6" class="text-center">Belum ada aset</td>
                            </tr>
                        @endif
                        @foreach ($assets as $asset)
                            <tr>
                                <td>
                                    {{ ($assets->currentpage() - 1) * $assets->perpage() + $loop->index + 1 }}
                                </td>
                                <td>{{ $asset->tipe }}</td>
                                <td>{{ $asset->keterangan }}</td>
                                <td>
                                    <img src="{!! $asset->fileUrl !!}" alt="{{ $asset->keterangan }}"
                                        class="img img-fluid" style="max-width: 50px" />
                                </td>
                                @if ($karya->isCreator())
                                    <td>
                                        <a class=" btn btn-sm btn-warning mb-1 mr-1"
                                            href="{{ route('admin.master.karya.asset.edit', [
                                                'karya' => $karya,
                                                'asset' => $asset,
                                                'redirect' => request()->url(),
                                            ]) }}">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        <form class="d-inline"
                                            action="{{ route('admin.master.karya.asset.destroy', [
                                                'karya' => $karya,
                                                'asset' => $asset,
                                                'redirect' => request()->url(),
                                            ]) }}"
                                            onsubmit="return confirmDelete()" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" name="submit"
                                                class="btn btn-sm btn-danger mb-1 mr-1"><i class="fa fa-trash"
                                                    aria-hidden="true"></i>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $assets->links() }}
        </div>
    </div>
</div>
