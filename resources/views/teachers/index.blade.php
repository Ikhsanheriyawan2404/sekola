@extends('layouts.app', compact('title'))

@section('content')
@include('sweetalert::alert')

{{-- {{dd($teachers->find($study->id)->studies())}} --}}
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">{{ $title ?? '' }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">{{ Breadcrumbs::render('teachers') }}</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid mb-3 d-flex justify-content-end">
    <div class="row">
        <div class="col-12">
            @can('teacher-create')
                <a href="{{ route('teachers.create') }}" class="btn btn-sm btn-primary">Tambah <i class="fa fa-plus"></i></a>
                <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#importExcel">Impor <i class="fa fa-file-import"></i></a>
                <a href="{{ route('teachers.export') }}" class="btn btn-sm btn-success" target="_blank">Ekspor <i class="fa fa-file-export"></i></a>
                <a href="{{ route('teachers.printpdf') }}" class="btn btn-sm btn-danger">Print PDF <i class="fa fa-file-pdf"></i></a>
            @endcan
        </div>
    </div>
</div>

<div class="container">
    @include('components.alerts')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Guru</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 1%">No.</th>
                        <th>Nama</th>
                        <th>NIP</th>
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
                <h4 class="modal-title" id="modal-title">Detail Guru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                <input type="hidden" name="tacherId" id="tacherId">
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item studies"></li>
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
            <form action="{{ route('teachers.import') }}" method="post" enctype="multipart/form-data">
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
                            <label class="custom-file-label" for="customFile">Pilih file</label>
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

<!-- bs-custom-file-input -->
<script src="{{ asset('asset') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
    $(function () {
        bsCustomFileInput.init();

        let table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,

            ajax: "{{ route('teachers.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'nip', name: 'nip'},
                {data: 'gender', name: 'gender'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });

        $('body').on('click', '#showItem', function () {
            let teacherId = $(this).data('id');
            let button = '';
            $.get("{{ route('teachers.index') }}" +'/' + teacherId, function (data) {
                $.each(data, function (index, val) {
                    button += `<button class="btn btn-primary mr-2 mb-2">${val.name}</button>`;
                });
                $(".studies").html(button);
                $('#modal-lg').modal('show');
                $('#modal-title').html("Mata Pelajaran Guru");
            })
        });

        $('body').on('click', '#deleteTeacher', function () {

            var teacherId = $(this).data("id");
            confirm("Apakah yakin ingin menghapus data ini!?");

            $.ajax({
                url: `{{ route('teachers.index') }}/${teacherId}`,
                type: "POST",
                data: {
                    'id': 'teacherId',
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
