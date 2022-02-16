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
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="callout callout-danger">
                    <h5>Perhatian <i class="fa fa-bullhorn"></i></h5>

                    <p>Jika ada salah satu isi dari materi tidak muncul berarti memang tidak ada isinya. Silahkan hubungi guru yang terkait</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @foreach ($modules->where('study_id', $study->id) as $module)

                <div class="card card-primary card-outline collapsed-card">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3">{{ $module->title }}
                            @can('module-edit')
                            <a href="{{ route('modules.edit', [$module->id, $module->teacher_id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-alt"></i> Edit</a>
                            @endcan
                        </h3>
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#{{ strtok($module->topic, " ") }}" data-toggle="tab">Topik</a></li>
                            <li class="nav-item"><a class="nav-link" href="#{{ strtok($module->description, " ") }}" data-toggle="tab">Description</a></li>
                            <li class="nav-item"><a class="nav-link" href="#{{
                            strtok(str_replace("file/", "", $module->file), ".")
                            }}" data-toggle="tab">Bahan Ajar</a></li>
                            <li class="nav-item"><a class="nav-link" href="#{{ strtok($module->reference, " ") }}" data-toggle="tab">Referensi</a></li>

                            <li class="nav-item">
                                <div class="card-tools nav-link">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </li>
                        </ul>
                        <!-- /.card-tools -->
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="{{ strtok($module->topic, " ") }}">
                                {{ $module->topic }}
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="{{ strtok($module->description, " ") }}">
                                {{ $module->description }}
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="{{
                                strtok(str_replace("file/", "", $module->file), ".") }}">
                                <a href="/storage/{{ $module->file }}">{{ str_replace("file/", "", $module->file) }}</a>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="{{ strtok($module->reference, " ") }}">
                                {{ $module->reference }}
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                    <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>

                @endforeach
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
