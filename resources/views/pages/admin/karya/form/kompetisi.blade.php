<div class="form-group">
    <label for="input__judul">Judul</label>
    <input id="input__judul" type="text" class="form-control" name="judul"
        value="{{ old('judul') ?? ($karya ? $karya->judul : '') }}">
    @error('judul')
        <div class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="input__jenis_kompetisi">Jenis Kompetisi</label>
            <select name="jenis_kompetisi" id="input__jenis_kompetisi" class="form-control">
                <option value="">-- Pilih Jenis --</option>
                @foreach ($jenisKompetisi as $item)
                    <option value="{{ $item->id }}" @if (old('jenis_kompetisi') ?? ($detail ? $detail->jenis_kompetisi : '') == $item->id) selected @endif>
                        {{ $item->name }}</option>
                @endforeach
            </select>
            @error('jenis_kompetisi')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">

        <div class="form-group">
            <label for="input__tingkat_kompetisi">Tingkat Kompetisi</label>
            <select name="tingkat_kompetisi" id="input__tingkat_kompetisi" class="form-control">
                <option value="">-- Pilih Jenis --</option>
                @foreach ($tingkatKompetisi as $item)
                    <option value="{{ $item->id }}" @if (old('tingkat_kompetisi') ?? ($detail ? $detail->tingkat_kompetisi : '') == $item->id) selected @endif>
                        {{ $item->name }}</option>
                @endforeach
            </select>
            @error('tingkat_kompetisi')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
    </div>
</div>


<div class="form-group">
    <label for="input__tempat_kompetisi">Tempat Kompetisi</label>
    <input name="tempat_kompetisi" id="input__tempat_kompetisi" class="form-control"
        value="{{ old('tempat_kompetisi') ?? ($detail ? $detail->tempat_kompetisi : '') }}" />
    @error('tempat_kompetisi')
        <div class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="input__tanggal_mulai">Tanggal Mulai</label>
            <input name="tanggal_mulai" type="date" id="input__tanggal_mulai" class="form-control"
                value="{{ old('tanggal_mulai') ?? ($detail ? $detail->tanggal_mulai : '') }}" />
            @error('tanggal_mulai')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">

        <div class="form-group">
            <label for="input__tanggal_akhir">Tanggal Akhir</label>
            <input name="tanggal_akhir" type="date" id="input__tanggal_akhir" class="form-control"
                value="{{ old('tanggal_akhir') ?? ($detail ? $detail->tanggal_akhir : '') }}" />
            @error('tanggal_akhir')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
    </div>
</div>


<div class="form-group">
    <label for="input__jumlah_peserta">Jumlah Peserta</label>
    <input name="jumlah_peserta" type="number" id="input__jumlah_peserta" class="form-control" min="1"
        value="{{ old('jumlah_peserta') ?? ($detail ? $detail->jumlah_peserta : '') }}" />
    @error('jumlah_peserta')
        <div class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="input__penghargaan">Penghargaan</label>
    <input name="penghargaan" id="input__penghargaan" class="form-control"
        value="{{ old('penghargaan') ?? ($detail ? $detail->penghargaan : '') }}" />
    @error('penghargaan')
        <div class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="input__thumbnail">Thumbnail</label>
    <input name="thumbnail" type="file" id="input__thumbnail" class="form-control" accept="image/*"
        value="{{ old('thumbnail') ?? ($detail ? $detail->thumbnail : '') }}" />
    @error('thumbnail')
        <div class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="input__deskripsi">Deskripsi</label>
    <input type="hidden" name="deskripsi" id="input__deskripsi">
    <div id="editor"></div>
    @error('deskripsi')
        <div class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="input__youtube_url">Youtube</label>
    <input name="youtube_url" id="input__youtube_url" class="form-control"
        value="{{ old('youtube_url') ?? ($detail ? $detail->youtube_url : '') }}" />
    <span class="text-small">isikan - jika tidak ada</span>
    @error('youtube_url')
        <div class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="input__project_url">Github</label>
    <input name="project_url" id="input__project_url" class="form-control"
        value="{{ old('project_url') ?? ($detail ? $detail->project_url : '') }}" />
    <span class="text-small">isikan - jika tidak ada</span>
    @error('project_url')
        <div class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>
