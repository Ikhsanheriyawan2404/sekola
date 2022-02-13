<div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Hari <span class="text-danger">*</span></label>
                <select name="day" class="form-control select2 @error('day') is-invalid @enderror" style="width: 100%;">
                    <option selected disabled>Pilih hari</option>
                    <option value="Senin" {{ $schedule->day == 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option value="Selasa" {{ $schedule->day == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option value="Rabu" {{ $schedule->day == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="Kamis" {{ $schedule->day == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option value="Jum`at" {{ $schedule->day == 'Jum`at' ? 'selected' : '' }}>Jum'at</option>
                    <option value="Sabtu" {{ $schedule->day == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                    <option value="Minggu" {{ $schedule->day == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                </select>
                @error('day')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="start">Jam mulai <span class="text-danger">*</span></label>
                <input type="time" class="form-control @error('start') is_invalid @enderror" name="start" value="{{ $schedule->start ?? old('start') }}">
                @error('start')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="finished">Jam selesai <span class="text-danger">*</span></label>
                <input type="time" class="form-control @error('finished') is_invalid @enderror" name="finished" value="{{ $schedule->finished ?? old('finished') }}">
                @error('finished')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Guru <span class="text-danger">*</span></label>
                <select name="teacher_id" class="form-control select2 @error('teacher_id') is-invalid @enderror" style="width: 100%;">
                    <option selected disabled>Pilih pengajar</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ $teacher->id == $schedule->teacher_id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                    @endforeach
                </select>
                @error('teacher_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Mata pelajaran <span class="text-danger">*</span></label>
                <select name="study_id" class="form-control select2 @error('study_id') is-invalid @enderror" style="width: 100%;">
                    <option selected disabled>Pilih mapel</option>
                    @foreach ($studies as $study)
                        <option value="{{ $study->id }}" {{ $study->id == $schedule->study_id ? 'selected' : '' }}>{{ $study->name }}</option>
                    @endforeach
                </select>
                @error('study_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Kelas <span class="text-danger">*</span></label>
                <select name="classroom_id" class="form-control select2 @error('classroom_id') is-invalid @enderror" style="width: 100%;">
                    <option selected disabled>Pilih kelas</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" {{ $classroom->id == $schedule->classroom_id ? 'selected' : '' }}>{{ $classroom->name }}</option>
                    @endforeach
                </select>
                @error('classroom_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Ruang <span class="text-danger">*</span></label>
                <select name="room_id" class="form-control select2 @error('room_id') is-invalid @enderror" style="width: 100%;">
                    <option selected disabled>Pilih ruangan</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ $room->id == $schedule->room_id ? 'selected' : '' }}>{{ $room->name }}</option>
                    @endforeach
                </select>
                @error('room_id')
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
