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
            <li class="breadcrumb-item active">{{ Breadcrumbs::render('create_schedule') }}</li>
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
        <h3 class="card-title">Tambah Jadwal</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('schedules.store') }}" method="POST">
            @csrf
            @include('schedules.partials.form-control')
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
            $('.select2').select2({
                placeholder: 'Pilih mapel pengajar',
                allowClear: true,
            });

            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });

        });
    </script>
@endsection
