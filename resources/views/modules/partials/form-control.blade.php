<div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <input type="hidden" name="study_id" value="{{ $study->id ?? '' }}">
            <input type="hidden" name="classroom_id" value="{{ $classroom->id ?? '' }}">
            <input type="hidden" name="teacher_id" value="{{ auth()->user()->teacher_id ?? '' }}">
            <div class="form-group">
                <label for="title">Judul <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Masukan judul" value="{{ $module->title ?? old('title') }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="topic">Topik pelajaran</span></label>
                <input type="text" name="topic" class="form-control @error('topic') is-invalid @enderror" placeholder="Masukan topic" value="{{ $module->topic ?? old('topic') }}">
                @error('topic')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ $module->description ?? old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="customFile">File pembelajaran <small class="text-danger">Nama file harus jelas. Jangan menggunakan simbol ()#$%^&*-_=+!@</small></label>
                <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile">
                    <label class="custom-file-label" for="customFile">Pilih file</label>
                    @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="reference">Link referensi</label>
                <input type="url" name="reference" class="form-control @error('reference') is-invalid @enderror" placeholder="Masukan reference" value="{{ $module->reference ?? old('reference') }}">
                @error('reference')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>

<!-- /.card-body -->
<div class="card-footer">
    <button type="submit" class="btn btn-primary float-right">Submit</button>
</div>
