@extends('layouts.app', compact('title'))

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">{{ $title ?? '' }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            {{-- <li class="breadcrumb-item"><a href="#">{{ Breadcrumbs::render('home') }}</a></li> --}}
            <li class="breadcrumb-item active">{{ Breadcrumbs::render('majors') }}</li>
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
                <button id="createNewMajor" class="btn btn-sm btn-primary">Tambah</button>
            {{-- @endcan --}}
        </div>
    </div>
</div>

<div class="container">
    @include('components.alerts')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Jurusan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 1%">No.</th>
                        <th>Nama</th>
                        <th class="text-center" style="width: 15%"><i class="fas fa-cogs"></i></th>
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

<!-- MODAL -->
<div class="modal fade" id="modal-md">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Detail Jurusan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                <form id="majorForm" name="majorForm">
                    @csrf
                    <input type="hidden" name="majorId" id="majorId">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control mr-2" name="name" id="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create"></button>
                    </div>
                </form>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        let table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,

            ajax: "{{ route('majors.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });

        $('#createNewMajor').click(function () {
            setTimeout(function () {
                $('#name').focus();
            }, 500);
            $('#saveBtn').removeAttr('disabled');
            $('#saveBtn').html("Tambah");
            $('#majorId').val('');
            $('#majorForm').trigger("reset");
            $('#modal-title').html("Tambah Jurusan");
            $('#modal-md').modal('show');
        });

        $('body').on('click', '#editMajor', function () {
            var major_id = $(this).data('id');
            $.get("{{ route('majors.index') }}" +'/' + major_id +'/edit', function (data) {
                $('#modal-md').modal('show');
                setTimeout(function () {
                    $('#name').focus();
                }, 500);
                $('#modal-title').html(`Edit Jurusan : ${major_id}`);
                $('#saveBtn').removeAttr('disabled');
                $('#saveBtn').html("Edit");
                $('#majorId').val(data.id);
                $('#name').val(data.name);
            })
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();

            $.ajax({
                data: $('#majorForm').serialize(),
                url: "{{ route('majors.store') }}",
                type: "POST",
                // dataType: 'json',
                success: function (data) {
                    $('#majorForm').trigger("reset");
                    $('#saveBtn').html('Loading ...');
                    $('#saveBtn').attr('disabled', 'disabled');
                    $('#modal-md').modal('hide');
                    table.draw();
                },
                error: function (error) {
                    console.log('Error:', error);
                    $('#saveBtn').attr('disabled', 'disabled');
                    $('#saveBtn').html('Error');
                }
            });
        });

        $('body').on('click', '#deleteMajor', function () {

            var major_id = $(this).data("id");
            confirm("Apakah yakin ingin menghapus data ini!?");

            $.ajax({
                url: `{{ route('majors.index') }}/${major_id}`,
                type: "POST",
                data: {
                    'id': 'major_id',
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
