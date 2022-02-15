@extends('layouts.app', compact('title'))

@section('content')
@include('sweetalert::alert')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">{{ $title ?? '' }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            {{-- <li class="breadcrumb-item active">{{ Breadcrumbs::render('create_module', $) }}</li> --}}
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
        <h3 class="card-title">Edit Modul Kelas : {{ $classroom->name }} | Pelajaran : {{ $study->name }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('modules.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('modules.partials.form-control')
        </form>
    </div>
<!-- /.card -->
</div>

@endsection

@section('custom-scripts')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('asset') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(document).ready(function() {

            bsCustomFileInput.init();

            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
@endsection
