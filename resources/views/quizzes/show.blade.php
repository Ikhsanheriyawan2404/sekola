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
        <h3 class="card-title">Detail Quiz : {{ $quiz->title }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($questions as $question)
                        <div class="mb-4">
                            @if($question->image)
                            <img class="img-fluid" width="400px" src="/storage/{{ $question->image }}">
                            @endif
                            <p>Catatan : {{ $question->note }}</p>
                            <label>{{ $loop->iteration }}. {{ $question->question }}
                                <button onclick="event.preventDefault();document.getElementById('delete{{ $question->id }}').submit();" class="btn btn-xs btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form id="delete{{ $question->id }}" action="{{ route('questions.destroy', $question->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </label>
                            <div class="container">
                                @foreach ($question->choices as $choice)
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label {{ $question->answer == $choice->choice  ? 'text-success' : '' }}">{{ $choice->choice }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
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
