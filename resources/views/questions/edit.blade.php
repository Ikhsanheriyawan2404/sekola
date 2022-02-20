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
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                        <div class="form-group">
                            <label for="question">Pertanyaan <span class="text-danger">*</span></label>
                            <input type="text" name="question" class="form-control @error('question') is-invalid @enderror" placeholder="Masukan pertanyaan" value="{{ $question->question ?? old('question') }}">
                            @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="answer">Jawaban benar <span class="text-danger">*</span></label>
                            <select name="answer" id="answer" class="form-control select2 @error('answer') is-invalid @enderror" style="width: 100%;">
                                <option selected disabled>Pilih jawaban</option>
                                <option id="choice1"></option>
                                <option id="choice2"></option>
                                <option id="choice3"></option>
                                <option id="choice4"></option>
                            </select>
                            @error('answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="note">Catatan</label>
                            <input type="text" name="note" class="form-control @error('note') is-invalid @enderror" placeholder="Masukan catatan jika diperlukan" value="{{ $question->note ?? old('note') }}">
                            @error('note')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="customFile">Gambar <span>(tidak wajib)</span></label>

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
                    <div class="col-lg-6">
                        @foreach ($question->find($question->id)->choices()->get() as $item)

                            <div class="form-group">
                                <input type="text" value="{{ $item->id }}">
                                <label for="choice">Opsi 1 <span class="text-danger">*</span></label>
                                <input type="text" name="choice[]" id="choice" class="form-control @error('choice') is-invalid @enderror" placeholder="Masukan jawaban" value="{{ $item->choice ?? old('choice') }}">
                                @error('choice')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        @endforeach
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

@section('custom-scripts')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('asset') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>

        /* event listener */
        document.getElementsByName("choice[]")[0].addEventListener('change', fillOption1);
        document.getElementsByName("choice[]")[1].addEventListener('change', fillOption2);
        document.getElementsByName("choice[]")[2].addEventListener('change', fillOption3);
        document.getElementsByName("choice[]")[3].addEventListener('change', fillOption4);

        /* function */
        function fillOption1 () {
            choice1 = document.getElementById('choice1');
            choice1.innerHTML = this.value
        }

        function fillOption2 () {
            choice2 = document.getElementById('choice2');
            choice2.innerHTML = this.value
        }

        function fillOption3 () {
            choice3 = document.getElementById('choice3');
            choice3.innerHTML = this.value
        }

        function fillOption4 () {
            choice4 = document.getElementById('choice4');
            choice4.innerHTML = this.value
        }
    </script>
@endsection
