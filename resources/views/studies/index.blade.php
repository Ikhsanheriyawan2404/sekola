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
            <li class="breadcrumb-item active">{{ Breadcrumbs::render('studies') }}</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid mb-3 d-flex justify-content-end">
    <div class="row">
        <div class="col-12">
            {{-- @can('item-create') --}}
                <a href="{{ route('studies.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            {{-- @endcan --}}
        </div>
    </div>
</div>

<div class="container">
    @include('components.alerts')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Mata Pelaran</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 1%">No.</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Tipe</th>
                        <th class="text-center"><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
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
<link rel="stylesheet" href="{{ asset('asset')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('custom-scripts')

<!-- DataTables  & Plugins -->
<script src="{{ asset('asset')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('asset')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('asset')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('asset')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('asset')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('asset')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('asset')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('asset')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('asset')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('asset')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('asset')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('asset')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(function () {

        let table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,

            ajax: "{{ route('studies.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'major', name: 'major.name'},
                {data: 'type', name: 'type'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });

        $('body').on('click', '#deleteClassroom', function () {

            var studyId = $(this).data("id");
            confirm("Apakah yakin ingin menghapus data ini!?");

            $.ajax({
                url: `{{ route('studies.index') }}/${studyId}`,
                type: "POST",
                data: {
                    'id': 'studyId',
                    '_method': 'DELETE',
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    alert(error);
                }
            });
        });

    });
</script>

@endsection
