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
            {{-- <li class="breadcrumb-item active">{{ Breadcrumbs::render('items', $items) }}</li> --}}
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $students->count() }}</h3>

              <p>Siswa</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('students.index', []) }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $teachers->count() }}</h3>

              <p>Guru</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('teachers.index', []) }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $classrooms->count() }}</h3>

              <p>Kelas</p>
            </div>
            <div class="icon">
              <i class="fa fa-chalkboard"></i>
            </div>
            <a href="{{ route('classrooms.index', []) }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $majors->count() }}</h3>

              <p>Jurusan</p>
            </div>
            <div class="icon">
              <i class="fa fa-book-open"></i>
            </div>
            <a href="{{ route('majors.index', []) }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection
