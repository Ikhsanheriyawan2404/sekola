<div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="name">Nama guru <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nama" value="{{ $teacher->name ?? old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="nip">NIP <span class="text-danger">*</span></label>
                <input type="number" name="nip" class="form-control @error('nip') is-invalid @enderror" placeholder="Masukan nomor identitas pegawai" value="{{ $teacher->nip ?? old('nip') }}">
                @error('nip')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Jenis kelamin <span class="text-danger">*</span></label>
                <select name="gender" class="form-control select2 @error('gender') is-invalid @enderror" style="width: 100%;">
                    <option selected disabled>Pilih jenis kelamin</option>
                    <option value="L" {{ $teacher->gender == 'L' ? 'selected' : '' }}>Laki - Laki</option>
                    <option value="P" {{ $teacher->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            {{-- <div class="form-group">
                <label>Agama <span class="text-danger">*</span></label>
                <select name="religion" class="form-control select2 @error('religion') is-invalid @enderror" style="width: 100%;">
                    <option selected disabled>Pilih agama</option>
                    <option value="Islam" {{ $teacher->religion == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ $teacher->religion == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ $teacher->religion == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ $teacher->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ $teacher->religion == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Khonghucu" {{ $teacher->religion == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                </select>
                @error('religion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> --}}
            {{-- <div class="form-group">
                <label for="name">Tanggal lahir <span class="text-danger">*</span></label>
                <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" placeholder="Masukan nama" value="{{ $teacher->date_of_birth ?? old('date_of_birth') }}">
                @error('date_of_birth')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div> --}}
            <div class="form-group">
                <label for="name">Nomor telepon <span class="text-danger">*</span></label>
                <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Masukan nomor telepon" value="{{ $teacher->phone ?? old('phone') }}">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Alamat email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="cth: user@mail.test" value="{{ $teacher->name ?? old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            {{-- <div class="form-group">
                <label for="address">Alamat tempat tinggal</label>
                <textarea name="address" class="form-control @error('address') is-invalid @enderror">{{ $teacher->address ?? old('address') }}</textarea>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> --}}
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="customFile">Foto <span class="text-danger">*</span></label>

                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="customFile">
                    <label class="custom-file-label" for="customFile">Pilih foto</label>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.card-body -->
<div class="card-footer">
    <button type="submit" class="btn btn-primary float-right">Submit</button>
</div>
