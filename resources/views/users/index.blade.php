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

<div class="container-fluid mb-3 d-flex justify-content-end">
    <div class="row">
        <div class="col-12">
            @can('user-create')
            <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            @endcan
        </div>
    </div>
</div>

<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 1%">No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-center" style="width: 15%"><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->getRoleNames() as $role)
                            <button class="btn btn-sm btn-primary">{{ $role }}</button>
                            @endforeach
                        </td>
                        <td class="d-flex justify-content-between">
                            @can('user-list')<a id="user_details" data-id="{{ $user->id }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>@endcan

                            @can('user-edit')
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>
                            @endcan

                            @can('user-delete')
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus ini?')"><i class="fas fa-trash"></i></button>
                                @csrf
                                @method('DELETE')
                            </form>
                            @endcan
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

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <ul class="list-group">
                <li class="list-group-item" id="name"></li>
                <li class="list-group-item" id="email"></li>
                <li class="list-group-item" id="address"></li>
            </ul>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection

@section('custom-scripts')

<script>
$(document).ready(function () {

    function timeFormatter(dateTime){
        var date = new Date(dateTime);
        if (date.getHours()>=12){
            var hour = parseInt(date.getHours()) - 12;
            var amPm = "PM";
        } else {
            var hour = date.getHours();
            var amPm = "AM";
        }
        var time = hour + ":" + date.getMinutes() + " " + amPm;
        console.log(time);
        return time;
    }

    $('body').on('click', '#user_details', function () {
        var user_id = $(this).data('id');
        $.get("{{ route('users.index') }}" +'/' + user_id, function (data) {
            $('#modal-default').modal('show');
            $('.modal-title').html("Data Pengguna : " + data.name);
            $('#name').html("Nama: " + data.name);
            $('#email').html("Email: " + data.email);
            $('#address').html("Alamat: " + data.address);
            var time = new Date();
            $('#address').html("Dibuat: " + timeFormatter(data.created_at));
        })
    });
});
</script>

@endsection
