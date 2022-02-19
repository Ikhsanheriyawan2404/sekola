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
        <h3 class="card-title">Edit Soal</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('questions.partials.form-control')
        </form>
    </div>
<!-- /.card -->
</div>

@endsection

@section('custom-scripts')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('asset') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $('.choice').on('change',function(){
            var arr = [];
            $siblings = $(this).siblings();
            $.each($siblings, function (i, key) {
            arr.push($(key).val());
            });
            if ($.inArray($(this).val(), arr) !== -1)
            {
                alert("duplicate has been found");
            }
        });
    </script>
    <script>

    </script>
@endsection
