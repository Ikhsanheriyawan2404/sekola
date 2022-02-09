@extends('layouts.app', compact('title'))

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">{{ $title ?? '' }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            {{-- <li class="breadcrumb-item"><a href="#">{{ Breadcrumbs::render('home') }}</a></li> --}}
            <li class="breadcrumb-item active">{{ Breadcrumbs::render('create_user') }}</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid">
<!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Tambah Siswa</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Nama pendaftar <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nama" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nisn">Nisn pendaftar <span class="text-danger">*</span></label>
                            <input type="number" name="nisn" class="form-control @error('nisn') is-invalid @enderror" placeholder="Masukan nisn" value="{{ old('nisn') }}">
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
                                <option value="L">Laki - Laki</option>
                                <option value="P">Perempuan</option>
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
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Khonghucu">Khonghucu</option>
                            </select>
                            @error('religion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Tanggal lahir <span class="text-danger">*</span></label>
                            <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" placeholder="Masukan nama" value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Nomor telepon <span class="text-danger">*</span></label>
                            <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Masukan nomor telepon" value="{{ old('phone') }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="email">Alamat email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="cth: user@mail.test" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="address">Alamat tempat tinggal</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
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
                                <input type="file" name="photo" class="custom-file-input @error('photo') is-invalid @enderror" id="customFile">
                                <label class="custom-file-label" for="customFile">Pilih foto</label>
                                @error('photo')
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
        </form>
    </div>
<!-- /.card -->
</div>

@endsection

@section('custom-styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/select2/css/select2.min.css">
@endsection

@section('custom-scripts')
    <!-- Select2 -->
    <script src="{{ asset('asset') }}/plugins/select2/js/select2.full.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('asset') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });

        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
