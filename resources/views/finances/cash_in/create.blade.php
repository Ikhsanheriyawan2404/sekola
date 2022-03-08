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
            <li class="breadcrumb-item active">{{ Breadcrumbs::render('create_cash_in') }}</li>
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
        <h3 class="card-title">Tambah Pemasukan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('finances.store_cash_in') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nama" value="{{ $student->name ?? old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cash_out">Nominal <span class="text-danger">*</span></label>
                            <input type="text" name="cash_in" id="cash_in" class="form-control @error('cash_in') is-invalid @enderror" placeholder="Masukan nominal" value="{{ $student->cash_in ?? old('cash_in') }}">
                            @error('cash_in')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ $student->description ?? old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">

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
    $(document).ready(function() {
        $('.select2').select2();

        $(document).on('submit', 'form', function() {
            $('button').attr('disabled', 'disabled');
        });
    });
</script>
<script type="text/javascript">
	var masuk = document.getElementById('cash_in');
	masuk.addEventListener('keyup', function (e) {
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatmasuk() untuk mengubah angka yang di ketik menjadi format angka
		masuk.value = formatmasuk(this.value, 'Rp ');
	});

	/* Fungsi formatmasuk */
	function formatmasuk(angka, prefix) {
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split = number_string.split(','),
			sisa = split[0].length % 3,
			masuk = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if (ribuan) {
			separator = sisa ? '.' : '';
			masuk += separator + ribuan.join('.');
		}

		masuk = split[1] != undefined ? masuk + ',' + split[1] : masuk;
		return prefix == undefined ? masuk : (masuk ? 'Rp ' + masuk : '');
	}
</script>
@endsection
