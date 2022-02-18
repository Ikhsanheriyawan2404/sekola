<div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="name">Nama kelas <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nama kelas" value="{{ $classroom->name ?? old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Wali kelas <span class="text-danger">*</span></label>
                <select name="teacher_id" class="form-control select2 @error('teacher_id') is-invalid @enderror" style="width: 100%;">
                    <option selected disabled>Pilih wali kelas</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ $teacher->id == $classroom->teacher_id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                    @endforeach
                </select>
                @error('teacher_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Kejuruan / keahlian <span class="text-danger">*</span></label>
                <select name="major_id" class="form-control select2 @error('major_id') is-invalid @enderror" style="width: 100%;">
                    <option selected disabled>Pilih jurusan</option>
                    @foreach ($majors as $major)
                        <option value="{{ $major->id }}" {{ $major->id == $classroom->major_id ? 'selected' : '' }}>{{ $major->name }}</option>
                    @endforeach
                </select>
                @error('major_id')
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
