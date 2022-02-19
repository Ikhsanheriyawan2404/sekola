<div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
            <div class="form-group">
                <label for="question">Pertanyaan <span class="text-danger">*</span></label>
                <input type="text" name="question" class="form-control @error('question') is-invalid @enderror" placeholder="Masukan pertanyaan" value="{{ $questions->question ?? old('question') }}">
                @error('question')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            {{-- <div class="form-group">
                <label for="answer">Jawaban benar <span class="text-danger">*</span></label>
                <select name="answer" id="answer" class="form-control select2 @error('answer') is-invalid @enderror" style="width: 100%;">
                    <option selected disabled>Pilih jawaban</option>
                    <option id="option1"></option>
                    <option id="option2"></option>
                    <option id="option3"></option>
                    <option id="option4"></option>
                </select>
                @error('answer')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> --}}
            <div class="form-group">
                <label for="">answer</label>
                <input type="text" name="answer" class="form-control @error('answer') is-invalid @enderror">
                @error('answer')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="note">Catatan</label>
                <input type="text" name="note" class="form-control @error('note') is-invalid @enderror" placeholder="Masukan catatan jika diperlukan" value="{{ $questions->note ?? old('note') }}">
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
            <div class="form-group">
                <label for="choice">Opsi 1 <span class="text-danger">*</span></label>
                <input type="text" name="choice[]" id="choice1" class="form-control @error('choice') is-invalid @enderror" placeholder="Masukan jawaban" value="{{ $questions->choice ?? old('choice') }}">
                @error('choice')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="choice">Opsi 2 <span class="text-danger">*</span></label>
                <input type="text" name="choice[]" id="choice2" class="form-control @error('choice') is-invalid @enderror" placeholder="Masukan jawaban" value="{{ $questions->choice ?? old('choice') }}">
                @error('choice')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="choice">Opsi 3 <span class="text-danger">*</span></label>
                <input type="text" name="choice[]" id="choice3" class="form-control @error('choice') is-invalid @enderror" placeholder="Masukan jawaban" value="{{ $questions->choice ?? old('choice') }}">
                @error('choice')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="choice">Opsi 4 <span class="text-danger">*</span></label>
                <input type="text" name="choice[]" id="choice4" class="form-control @error('choice') is-invalid @enderror" placeholder="Masukan jawaban" value="{{ $questions->choice ?? old('choice') }}">
                @error('choice')
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
    <a type="button" onclick="myFunction();">Ha</a>
    <button type="submit" class="btn btn-primary float-right">Submit</button>
</div>
