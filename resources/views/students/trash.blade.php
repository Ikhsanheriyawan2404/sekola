@extends('layouts.app', compact('title'))

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
            <li class="breadcrumb-item active">{{ Breadcrumbs::render('student_trash') }}</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid mb-3 d-flex justify-content-end">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('students.deleteAll') }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Apakah yakin ingin menghapus semua data secara permanen?')" class="btn btn-sm btn-danger">Hapus semua <i class="fa fa-trash"></i></button>
            </form>
        </div>
    </div>
</div>

<div class="container">
    @include('components.alerts')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Siswa</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 1%">No.</th>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th class="text-center" style="width: 20%"><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->nisn }}</td>
                        <td>{{ $student->classroom->name }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->religion }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('students.restore', $student->id) }}" class="btn btn-success btn-sm mr-2">Restore <i class="fa fa-trash-restore"></i></a>
                            <form action="{{ route('students.deletePermanent', $student->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah yakin ingin menghapus data ini permanen?')" class="btn btn-danger btn-sm">Hapus <i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection
