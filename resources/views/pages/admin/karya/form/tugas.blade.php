<div class="form-group">
    <label for="input__mata_kuliah_id">Mata Kuliah</label>
    <select name="mata_kuliah_id" id="input__mata_kuliah_id" class="form-control">
        <option value="">Pilih Mata Kuliah</option>
        @foreach ($listMatakuliah as $matkul)
            <option value="{{ $matkul->id }}" @if ($matkul->id == (old('mata_kuliah_id') || ($detail ? $detail->mata_kuliah_id : ''))) selected @endif>
                {{ $matkul->name }}</option>
        @endforeach
    </select>
    @error('mata_kuliah_id')
        <div class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>

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
    <input type="hidden" name="deskripsi" id="input__deskripsi">
    <div id="editor"></div>
    @error('deskripsi')
        <div class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>
