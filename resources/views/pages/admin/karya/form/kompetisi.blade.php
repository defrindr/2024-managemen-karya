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
            <input name="jenis_kompetisi" id="input__jenis_kompetisi" class="form-control"
                value="{{ old('jenis_kompetisi') ?? ($detail ? $detail->jenis_kompetisi : '') }}" />
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
            <input name="tingkat_kompetisi" id="input__tingkat_kompetisi" class="form-control"
                value="{{ old('tingkat_kompetisi') ?? ($detail ? $detail->tingkat_kompetisi : '') }}" />
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
    <input name="jumlah_peserta" type="number" id="input__jumlah_peserta" class="form-control"
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