<div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="name">Nama mapel <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nama mata pelajaran" value="{{ $study->name ?? old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="study_code">Kode mata pelajaran</label>
                <input type="text" name="study_code" class="form-control @error('study_code') is-invalid @enderror" placeholder="Masukan kode mapel" value="{{ $study->study_code ?? old('study_code') }}">
                @error('study_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Jenis mapel <span class="text-danger">*</span></label>
                <select name="type" class="form-control select2 @error('type') is-invalid @enderror" style="width: 100%;">
                    <option selected disabled>Pilih jenis / tipe</option>
                    <option value="Umum" {{ $study->type == 'Umum' ? 'selected' : '' }}>Umum</option>
                    <option value="Kejuruan" {{ $study->type == 'Kejuruan' ? 'selected' : '' }}>Kejuruan</option>
                    <option value="Khusus" {{ $study->type == 'Khusus' ? 'selected' : '' }}>Khusus</option>
                </select>
                @error('type')
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
                        <option value="{{ $major->id }}" {{ $major->id == $study->major_id ? 'selected' : '' }}>{{ $major->name }}</option>
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
