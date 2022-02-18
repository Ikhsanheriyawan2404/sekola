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
                        <h3 class="card-title">Ulangan </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Jam mulai - selesai</th>
                                    <th>Waktu Pelaksanaan</th>
                                    <th>Jumlah Soal</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width: 100px;"><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quizzes as $quiz)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $quiz->title }}</td>
                                    <td>{{ date('d-m-Y', strtotime($quiz->date)) }}</td>
                                    <td>{{ date('H:m', strtotime($quiz->start)) }} - {{ date('H:m', strtotime($quiz->finished)) }}</td>
                                    <td>{{ $quiz->time }} Menit</td>
                                    <td>{{ $quiz->number_of_questions }}</td>
                                    <td>{{ $quiz->status == '1' ? 'Aktif' : 'Tidak aktif' }}</td>
                                    <td>
                                        <a href="{{ route('modules.show', $quiz->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        <a href="{{ route('modules.show', $quiz->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
