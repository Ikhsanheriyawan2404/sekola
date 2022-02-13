@extends('layouts.app', compact('title'))

@section('content')
@include('sweetalert::alert')

<!-- Content Header (Page header) -->
<div class="content-header">
    {{-- {{dd($schedules)}} --}}
    {{-- {{dd($classroom)}} --}}
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">{{ $title ?? '' }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">{{ Breadcrumbs::render('show_schedule') }}</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid mb-3 d-flex justify-content-end">
    <div class="row">
        <div class="col-12">
        </div>
    </div>
</div>

<div class="container">
    @include('components.alerts')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Jadwal</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 1%">No.</th>
                        <th>Hari</th>
                        <th>Pelajaran</th>
                        <th>Kelas</th>
                        <th>Ruang</th>
                        <th>Jam Pelajaran</th>
                        <th class="text-center"><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($schedules->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data jadwal</td>
                        </tr>
                    @endif
                    @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $schedule->day }}</td>
                        <td>
                            {{ $schedule->study->name }}
                            <small class="text-muted"></small>
                        </td>
                        <td>{{ $schedule->classroom->name }}</td>
                        <td>{{ $schedule->room->name }}</td>
                        <td>{{ date('H:i', strtotime($schedule->start)) }} - {{ date('H:i', strtotime($schedule->finished)) }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-sm btn-primary mr-2"><i class="fas fa-pencil-alt"></i></a>
                            <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus ini?')"><i class="fas fa-trash"></i></button>
                                @csrf
                                @method('DELETE')
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
