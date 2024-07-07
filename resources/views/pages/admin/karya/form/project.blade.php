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

<div class="form-group">
    <label for="input__deskripsi">Deskripsi</label>
    <textarea name="deskripsi" id="input__deskripsi" cols="30" rows="10" class="form-control"></textarea>
    @error('deskripsi')
        <div class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>
