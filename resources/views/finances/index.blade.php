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
            <li class="breadcrumb-item active">{{ Breadcrumbs::render('finances') }}</li>
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
                        <h5>@currency($finances->sum('cash_in') - $finances->sum('cash_out'))</h5>
                        <p>Saldo</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money-bill"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h5>@currency($finances->sum('cash_in'))</h5>
                        <p>Pemasukan</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money-bill"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h5>@currency($finances->sum('cash_out'))</h5>
                        <p>Pengeluaran</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money-bill"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<div class="container-fluid mb-3 d-flex justify-content-end">
    <div class="row">
        <div class="col-12">
            @can('finance-create')
                <a href="{{ route('finances.create_cash_in') }}" class="btn btn-sm btn-primary">Tambah Pemasukan <i class="fa fa-plus"></i></a>
                <a href="{{ route('finances.create_cash_out') }}" class="btn btn-sm btn-primary">Tambah Pengeluaran <i class="fa fa-plus"></i></a>
                <a href="{{ route('finances.export') }}" class="btn btn-sm btn-success">Export <i class="fa fa-file-export"></i></a>
                <a href="{{ route('finances.print') }}" class="btn btn-sm btn-danger">Print PDF <i class="fa fa-print"></i></a>
            @endcan
        </div>
    </div>
</div>

<div class="container">
    @include('components.alerts')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Keuangan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 1%">No.</th>
                        <th>Nama</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
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
$(function () {

    // Menampilkan data menggunakan datatables
    let table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,

        ajax: "{{ route('finances.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'cash_in', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )},
            {data: 'cash_out', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )},
            {data: 'description', name: 'description'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: true, searchable: true},
        ]
    });

});
</script>

@endsection
