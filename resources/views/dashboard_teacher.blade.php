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
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Mata Pelajaran</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th style="width: 200px" class="text-center"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules->where('teacher_id', $teacher->id) as $schedule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $schedule->classroom->name }}</td>
                                <td>{{ $schedule->study->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('modules.show', $schedule->study->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat</a>
                                    <a href="{{ route('modules.create',[$schedule->study->id, $schedule->classroom->id]) }}" class="btn btn-primary btn-sm">Tambah Modul</a>
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

            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Kelas</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Kelas</th>
                                <th style="width: 100px" class="text-center"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classrooms->where('teacher_id', $teacher->id) as $classroom)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $classroom->name }}</td>
                                <td class="text-center">
                                    <a href"" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat</a>
                                </td>
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
                        <img class="img-circle elevation-2" src="{{ $teacher->takeImage }}" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">{{ $teacher->name }}</h3>
                        {{-- <h5 class="widget-user-desc">{{ $teacher->}}</h5> --}}
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">NIP :
                                {{ $teacher->nip }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Jenis Kelamin :
                                {{ $teacher->gender == 'L' ? 'Laki-Laki' : 'Perempuan'}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Email :
                                {{ $teacher->email }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">No HP :
                                {{ $teacher->phone }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="{{ route('users.show', $teacher->id) }}" class="btn btn-primary mb-3 float-right">Edit Password <i class="fa fa-pencil-alt"></i></a>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
