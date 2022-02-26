<div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="name">Nama pendaftar <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nama" value="{{ $student->name ?? old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="nisn">Nisn pendaftar <span class="text-danger">*</span></label>
                <input type="number" name="nisn" class="form-control @error('nisn') is-invalid @enderror" placeholder="Masukan nisn" value="{{ $student->nisn ?? old('nisn') }}">
                @error('nisn')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Jenis kelamin <span class="text-danger">*</span></label>
                <select name="gender" class="form-control select2 @error('gender') is-invalid @enderror" style="width: 100%;">
                    <option selected disabled>Pilih jenis kelamin</option>
                    <option value="L" {{ $student->gender == 'L' ? 'selected' : '' }}>Laki - Laki</option>
                    <option value="P" {{ $student->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Agama <span class="text-danger">*</span></label>
                <select name="religion" class="form-control select2 @error('religion') is-invalid @enderror" style="width: 100%;">
                    <option selected disabled>Pilih agama</option>
                    <option value="Islam" {{ $student->religion == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ $student->religion == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ $student->religion == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ $student->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ $student->religion == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Khonghucu" {{ $student->religion == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                </select>
                @error('religion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Tanggal lahir <span class="text-danger">*</span></label>
                <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" placeholder="Masukan nama" value="{{ $student->date_of_birth ?? old('date_of_birth') }}">
                @error('date_of_birth')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Alamat tempat tinggal</label>
                <textarea name="address" class="form-control @error('address') is-invalid @enderror">{{ $student->address ?? old('address') }}</textarea>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
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
            <div class="form-group">
                <label>Kelas <span class="text-danger">*</span></label>
                <select name="classroom_id" class="form-control select2 @error('classroom_id') is-invalid @enderror" style="width: 100%;">
                    <option selected disabled>Pilih kelas</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" {{ $classroom->id == $student->classroom_id ? 'selected' : '' }}>{{ $classroom->name }}</option>
                    @endforeach
                </select>
                @error('classroom_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Nomor telepon <span class="text-danger">*</span></label>
                <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Masukan nomor telepon" value="{{ $student->phone ?? old('phone') }}">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Alamat email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="cth: user@mail.test" value="{{ $student->email ?? old('email') }}">
                @error('email')
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
