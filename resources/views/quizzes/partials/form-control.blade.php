<div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <input type="hidden" name="study_id" value="{{ $study->id ?? '' }}">
            <input type="hidden" name="teacher_id" value="{{ auth()->user()->teacher_id ?? '' }}">
            <input type="hidden" name="classroom_id" value="{{ $classroom->id ?? '' }}">
            <div class="form-group">
                <label for="title">Judul <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Masukan judul" value="{{ $quiz->title ?? old('title') }}" autofocus>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="number_of_questions">Jumlah soal</span></label>
                <input type="number" name="number_of_questions" class="form-control @error('number_of_questions') is-invalid @enderror" placeholder="Masukan jumlah soal" value="{{ $quiz->number_of_questions ?? old('number_of_questions') }}">
                @error('number_of_questions')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="time">Waktu pelaksanaan <span class="text-danger">*</span></label>
                <small>note : format waktu menit</small>
                <input type="number" name="time" placeholder="contoh : 60" class="form-control @error('time') is-invalid @enderror" value="{{ $quiz->time ?? old('time') }}">
                @error('time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="date">Tanggal pelaksanaan</span></label>
                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" placeholder="Masukan tanggal" value="{{ $quiz->date ?? old('date') }}">
                @error('date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="start">Jam mulai</span></label>
                <input type="time" name="start" class="form-control @error('start') is-invalid @enderror" value="{{ $quiz->start ?? old('start') }}">
                @error('start')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="finished">Jam selesai</span></label>
                <input type="time" name="finished" class="form-control @error('finished') is-invalid @enderror" value="{{ $quiz->finished ?? old('finished') }}">
                @error('finished')
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
