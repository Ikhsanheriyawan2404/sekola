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
            <li class="breadcrumb-item active">{{ Breadcrumbs::render('classrooms') }}</li>
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
            <h3 class="card-title">Data Kelas {{ $classroom->name }}</h3>
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
                    @foreach ($student as $stu)

                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- MODAL -->
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Detail Guru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                <input type="hidden" name="tacherId" id="tacherId">
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item"><img class="img-fluid" style="max-height: 150px;overflow:hidden;" src="a.jpg" id="photo"></li>
                        <li class="list-group-item name"></li>
                        <li class="list-group-item teacher"></li>
                        <li class="list-group-item major"></li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer justify-content-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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

    {{-- <script>
        $(function () {

            let table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,

                ajax: "{{ route('classrooms.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: true, searchable: true},
                ]
            });

            $('body').on('click', '#showClassroom', function () {
                var classroomId = $(this).data('id');
                $.get("{{ route('classrooms.index') }}" +'/' + classroomId, function (data) {
                    console.log(data);
                    $('#modal-lg').modal('show');
                    $('#modal-title').html("Detail Kelas");
                    $('#studentId').val(data.id);
                    $('.name').html('Nama : ' + data.name);
                    $('.teacher').html('Wali Kelas : ' + data.teacher_id);
                    $('.major').html('Jurusan : ' + data.major_id);
                })
           });

           $('body').on('click', '#deleteClassroom', function () {

                var classroomId = $(this).data("id");
                confirm("Apakah yakin ingin menghapus data ini!?");

                $.ajax({
                    url: `{{ route('classrooms.index') }}/${classroomId}`,
                    type: "POST",
                    data: {
                        'id': 'classroomId',
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
    </script> --}}

@endsection