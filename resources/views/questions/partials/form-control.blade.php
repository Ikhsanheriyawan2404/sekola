<div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
            <div class="form-group">
                <label for="question">Pertanyaan <span class="text-danger">*</span></label>
                <input type="text" name="question" class="form-control @error('question') is-invalid @enderror" placeholder="Masukan pertanyaan" value="{{ $quiz->question ?? old('question') }}">
                @error('question')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="answer">Jawaban benar <span class="text-danger">*</span></label>
                <input type="text" name="answer" class="form-control @error('answer') is-invalid @enderror" placeholder="Masukan jawaban" value="{{ $quiz->answer ?? old('answer') }}">
                @error('answer')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="note">Catatan</label>
                <input type="text" name="note" class="form-control @error('note') is-invalid @enderror" placeholder="Masukan catatan jika diperlukan" value="{{ $quiz->note ?? old('note') }}">
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
                <label for="option">Opsi 1 <span class="text-danger">*</span></label>
                <input type="text" name="choice[]" class="form-control @error('option') is-invalid @enderror" placeholder="Masukan jawaban" value="{{ $quiz->option ?? old('option') }}">
                @error('option')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="option">Opsi 2 <span class="text-danger">*</span></label>
                <input type="text" name="choice[]" class="form-control @error('option') is-invalid @enderror" placeholder="Masukan jawaban" value="{{ $quiz->option ?? old('option') }}">
                @error('option')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="option">Opsi 3 <span class="text-danger">*</span></label>
                <input type="text" name="choice[]" class="form-control @error('option') is-invalid @enderror" placeholder="Masukan jawaban" value="{{ $quiz->option ?? old('option') }}">
                @error('option')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="option">Opsi 4 <span class="text-danger">*</span></label>
                <input type="text" name="choice[]" class="form-control @error('option') is-invalid @enderror" placeholder="Masukan jawaban" value="{{ $quiz->option ?? old('option') }}">
                @error('option')
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
    <button type="submit" class="btn btn-primary float-right">Submit</button>
</div>
