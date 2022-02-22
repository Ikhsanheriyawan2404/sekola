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
            <li class="breadcrumb-item active">{{ Breadcrumbs::render('students') }}</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid mb-3 d-flex justify-content-end">
    <div class="row">
        <div class="col-12">
            @can('student-create')
                <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary">Tambah <i class="fa fa-plus"></i></a>
                <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#importExcel">Impor <i class="fa fa-file-import"></i></a>
                <a href="{{ route('students.export') }}" class="btn btn-sm btn-success" target="_blank">Ekspor <i class="fa fa-file-export"></i></a>
                <a href="{{ route('students.printpdf') }}" class="btn btn-sm btn-danger">Print PDF <i class="fa fa-file-pdf"></i></a>
            @endcan
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
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Detail Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                <input type="hidden" name="studentId" id="studentId">
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item"><img class="img-fluid" style="max-height: 150px;overflow:hidden;" src="" id="image"></li>
                        <li class="list-group-item name"></li>
                        <li class="list-group-item nisn"></li>
                        <li class="list-group-item gender"></li>
                        <li class="list-group-item religion"></li>
                        <li class="list-group-item date_of_birth"></li>
                        <li class="list-group-item phone"></li>
                        <li class="list-group-item address"></li>
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

<!-- MODAL IMPORT EXCEL -->
<div class="modal fade" id="importExcel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="{{ route('students.import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Import Excel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="customFile">Masukan file excel <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile" required>
                            <label class="custom-file-label" for="customFile">Pilih foto</label>
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal import excel -->

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

    <!-- bs-custom-file-input -->
    <script src="{{ asset('asset') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();

            let table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,

                ajax: "{{ route('students.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'nisn', name: 'nisn'},
                    {data: 'classroom', name: 'classroom.name'},
                    {data: 'gender', name: 'gender'},
                    {data: 'action', name: 'action', orderable: true, searchable: true},
                ]
            });

            $('body').on('click', '#showItem', function () {
                var studentId = $(this).data('id');
                $.get("{{ route('students.index') }}" +'/' + studentId, function (data) {
                    $('#modal-lg').modal('show');
                    $('#modal-title').html("Detail Siswa");
                    $('#studentId').val(data.id);
                    $('.name').html('Nama : ' + data.name);
                    $('.nisn').html('NISN : ' + data.nisn);
                    $('.gender').html('Jenis Kelamin : ' + data.gender);
                    $('.date_of_birth').html('Tanggal Lahir : ' + data.date_of_birth);
                    $('.religion').html('Agama : ' + data.religion);
                    $('.phone').html('No HP : ' + data.phone);
                    $('.address').html('Alamat : ' + data.address);
                    $('#image').attr("src", "/storage/" + data.image);
                })
           });

        });
    </script>

@endsection
