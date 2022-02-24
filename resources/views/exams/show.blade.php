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
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Info Quiz <i class="fa fa-bullhorn"></i></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: none;">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Waktu
                            <span class="badge badge-primary badge-pill">{{ $quiz->time }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Mata Pelajaran
                            <span class="badge badge-primary badge-pill">{{ $quiz->study->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Guru
                            <span class="badge badge-primary badge-pill">{{ $quiz->teacher->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Waktu Mulai
                            <span class="badge badge-primary badge-pill">{{ $quiz->start }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Waktu Selesai
                            <span class="badge badge-primary badge-pill">{{ $quiz->finished }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            TATA TERTIB PESERTA UJIAN <br>
                            1. Dilarang menggunakan kalkulator. <br>
                            2. Dilarang mengikuti ujian dua mata pelajaran atau lebih pada jam ujian yang sama. <br>
                            3. Dilarang mengikuti ujian apabila terlambat lebih dari waktu yang ditentukan <br>
                            4. Dilarang bekerjasama menyelesaikan ujian dengan siapapun
                            juga. <br>
                            5. Dilarang menyalin/memfotokopi naskah ujian. <br>
                            6. Dilarang menyuruh orang lain untuk mengerjakan ujian
                            (menggunakan joki). <br>
                            7. Mentaati tata tertib peserta ujian. <br>
                            Perlu mendapat perhatian bahwa pelanggaran terhadap tata tertib ini akan diberikan sanksi akademik. <br>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
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
                            <div class="col-md-6">
                                @foreach ($questions as $key => $question)
                                <div class="card">
                                    <div class="card-body">
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
                                    </div>
                                </div>
                                @endforeach

                                <input type="hidden" name="index" value="{{ $key+1 }}">
                                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-right" onclick="return confirm('Apakah yakin dengan jawaban anda?')">Simpan</button>
                </div>
                </form>
            </div>
        <!-- /.card -->
        </div>
    </div>
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
