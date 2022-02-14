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
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Jadwal Pelajaran</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
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
                    <tr>
                    <td>1.</td>
                    <td>Update software</td>
                    <td>
                        <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                    </td>
                    <td><span class="badge bg-danger">55%</span></td>
                    </tr>
                    <tr>
                    <td>2.</td>
                    <td>Clean database</td>
                    <td>
                        <div class="progress progress-xs">
                        <div class="progress-bar bg-warning" style="width: 70%"></div>
                        </div>
                    </td>
                    <td><span class="badge bg-warning">70%</span></td>
                    </tr>
                    <tr>
                    <td>3.</td>
                    <td>Cron job running</td>
                    <td>
                        <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar bg-primary" style="width: 30%"></div>
                        </div>
                    </td>
                    <td><span class="badge bg-primary">30%</span></td>
                    </tr>
                    <tr>
                    <td>4.</td>
                    <td>Fix and squish bugs</td>
                    <td>
                        <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar bg-success" style="width: 90%"></div>
                        </div>
                    </td>
                    <td><span class="badge bg-success">90%</span></td>
                    </tr>
                </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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
                <a href="{{ route('users.show', $student->id) }}" class="btn btn-primary mb-3 float-right">Edit Password <i class="fa fa-pencil-alt"></i></a>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
