@extends('layouts.app')

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
            <li class="breadcrumb-item"><a href="#">{{ Breadcrumbs::render('home') }}</a></li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Jadwal Pelajaran {{ $student->classroom->name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Hari</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Jam Pelajaran</th>
                                    <th>Ruang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules->where('classroom_id', $student->classroom_id) as $schedule)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $schedule->day }}</td>
                                    <td>{{ $schedule->study->name }} <i class="text-muted">({{ $schedule->teacher->name }})</i></td>
                                    <td>{{ date('H:i', strtotime($schedule->start)) }} - {{ date('H:i', strtotime($schedule->finished)) }}</td>
                                    <td>{{ $schedule->room->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-primary">
                        <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{ $student->takeImage }}" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">{{ $student->name }}</h3>
                        <h5 class="widget-user-desc">{{ $student->classroom->name }}</h5>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">NIP :
                                {{ $student->nisn }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Jenis Kelamin :
                                {{ $student->gender == 'L' ? 'Laki-Laki' : 'Perempuan'}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Agama :
                                {{ $student->religion }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Tanggal Lahir :
                                {{ date("d-m-Y", strtotime($student->date_of_birth)) }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Alamat :
                                {{ $student->address }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Email :
                                {{ $student->email }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">No HP :
                                {{ $student->phone }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="{{ route('users.editUser', auth()->user()->id) }}" class="btn btn-primary mb-3 float-right">Edit Password <i class="fa fa-pencil-alt"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Pelajaran {{ $student->classroom->name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Mata Pelajaran</th>
                                    <th class="text-center" style="width: 100px;"><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules->where('classroom_id', $student->classroom_id) as $schedule)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $schedule->study->name }}</td>
                                    <td>
                                        <a href="{{ route('modules.show', $schedule->study->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Ulangan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>(Kelas) Mata Pelajaran</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Jam mulai - selesai</th>
                                    <th>Waktu Pelaksanaan</th>
                                    <th>Jumlah Soal</th>
                                    <th>Hasil</th>
                                    <th class="text-center" style="width: 150px;"><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quizzes->where('status', '1')->where('classroom_id', $student->classroom_id) as $quiz)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>({{ $quiz->classroom->name }}) {{ $quiz->study->name }}</td>
                                    <td>{{ $quiz->title }}</td>
                                    <td>{{ date('d-m-Y', strtotime($quiz->date)) }}</td>
                                    <td>{{ date('H:m', strtotime($quiz->start)) }} - {{ date('H:m', strtotime($quiz->finished)) }}</td>
                                    <td>{{ $quiz->time }} Menit</td>
                                    <td>{{ $quiz->number_of_questions }}</td>
                                    <td>
                                        @foreach ($quiz->results as $result)
                                            {{ 100 / $quiz->questions->count() * $result->correct }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($results->where('student_id', auth()
                                            ->user()->student_id)
                                            ->where('quiz_id', $quiz->id)->first() === null)
                                            <a type="button" href="{{ route('exams.show', $quiz->id) }}" class="btn btn-primary" onclick="return confirm('Yakin mulai ujian ini? Jika iya waktu akan mulai berjalan.')">Start</a>
                                        @else
                                            <button class="btn btn-primary disabled">Selesai</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
