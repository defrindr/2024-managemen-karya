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
