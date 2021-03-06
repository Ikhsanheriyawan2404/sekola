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
            <h3 class="card-title">Data Pengguna</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-striped">
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
                    {{-- @foreach ($users as $user)
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
                    @endforeach --}}
                </tbody>
            </table>
            {{-- <ul class="pagination my-3">
                {{ $users->links() }}
            </ul> --}}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection

@section('custom-styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('asset')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('asset')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('custom-scripts')

<!-- DataTables  & Plugins -->
<script src="{{ asset('asset')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('asset')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('asset')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('asset')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>

$(document).ready(function () {

    let table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,

        ajax: "{{ route('users.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'role', name: 'role'},
            {data: 'action', name: 'action', orderable: true, searchable: true},
        ]
    });
});
</script>

@endsection
