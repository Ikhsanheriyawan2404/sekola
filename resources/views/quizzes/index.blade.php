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

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Ulangan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>(Kelas) Mata Pelajaran</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Jam mulai - selesai</th>
                                    <th>Waktu Pelaksanaan</th>
                                    <th>Jumlah Soal</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width: 150px;"><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quizzes->where('teacher_id', $teacher->id) as $quiz)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>({{ $quiz->classroom->name }}) {{ $quiz->study->name }}</td>
                                    <td>{{ $quiz->title }}</td>
                                    <td>{{ date('d-m-Y', strtotime($quiz->date)) }}</td>
                                    <td>{{ date('H:m', strtotime($quiz->start)) }} - {{ date('H:m', strtotime($quiz->finished)) }}</td>
                                    <td>{{ $quiz->time }} Menit</td>
                                    <td>{{ $quiz->number_of_questions }}</td>
                                    <td>
                                        <form action="{{ route('quizzes.status', $quiz->id) }}" method="post">
                                            @csrf
                                            @if ($quiz->status == '1')
                                                <input type="hidden" name="status" value="0">
                                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                                            @elseif ($quiz->status == '0')
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                            @endif
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('quizzes.result', $quiz->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>Lihat hasil</a>
                                        <a href="{{ route('questions.create', $quiz->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>Tambah soal</a>
                                        <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('apakah yakin ingin menghapus ini!?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
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
    </div>
</div>

@endsection
