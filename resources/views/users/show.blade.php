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
            <li class="breadcrumb-item active">{{ Breadcrumbs::render('users') }}</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <form action="{{ route('edit.password', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="text-center">
                    @can('dashboard-teacher')
                        <img class="profile-user-img img-fluid img-circle" src="{{ $user->teacher->takeImage }}" alt="User profile picture">
                    @endcan
                    @can('dashboard-student')
                        <img class="profile-user-img img-fluid img-circle" src="{{ $user->student->takeImage }}" alt="User profile picture">
                    @endcan
                    </div>

                    <h3 class="profile-username text-center">{{ $user->name }}</h3>

                    <p class="text-muted text-center">{{ $user->email }}</p>

                    <div class="form-group">
                        <label for="password">Password Baru <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password')
                            is-invalid
                        @enderror" name="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password_confirmation')
                            is-invalid
                        @enderror" name="password_confirmation">
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary float-right"><b>Ubah Password</b></button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    </div>
</div>

@endsection

