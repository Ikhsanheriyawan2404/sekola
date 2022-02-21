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
        <form action="{{ route('exams.store') }}" method="post">
        @csrf
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($questions as $key => $question)
                        <div class="mb-4">
                            <input type="hidden" name="question_id{{ $key+1 }}" value="{{ $question->id }}">
                            <input type="hidden" name="answer{{$key+1}}">
                            @if($question->image)
                            <img class="img-fluid" width="400px" src="/storage/{{ $question->image }}">
                            @endif
                            <p>Catatan : {{ $question->note }}</p>
                            <label>{{ $loop->iteration }}. {{ $question->question }}
                            </label>
                            <div class="container">
                                @foreach ($question->choices as $choice)
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answer{{ $key+1 }}" value="{{ $choice->choice }}">
                                        <label class="form-check-label">{{ $choice->choice }}</label>
                                    </div>
                                </div>
                                @endforeach
                                <a class="btn-primary btn-sm">Simpan</a>
                            </div>
                        </div>
                        @endforeach

                        <input type="hidden" name="index" value="{{ $key+1 }}">
                        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary float-right">Save exams</button>
            </div>
        </div>
    </form>
<!-- /.card -->
</div>

@endsection

@section('custom-scripts')
    <script>
        $(document).ready(function() {

            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
@endsection
