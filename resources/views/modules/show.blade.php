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
            @can('dashboard-teacher')
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard', auth()->user()->teacher_id) }}">Home</a></li>
            @endcan
            @can('dashboard-student')
                <li class="breadcrumb-item"><a href="{{ route('student.dashboard', auth()->user()->student_id) }}">Home</a></li>
            @endcan
            <li class="breadcrumb-item active">Lihat Modul</li>
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

                <div class="card card-primary card-outline">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3">{{ $module->title }}
                            <div class="d-flex">
                                @can('module-edit')
                                <a href="{{ route('modules.edit', [$module->id, $module->teacher_id]) }}" class="btn btn-primary btn-xs mr-1"><i class="fa fa-pencil-alt"></i> Edit</a>
                                @endcan
                                @can('module-delete')
                                <form action="{{ route('modules.destroy', $module->id) }}" method="POST">
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button>
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endcan
                            </div>
                        </h3>
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item">
                                <a
                                class="nav-link active"
                                href=
                                "#{{ strtok($module->topic, " ") }}{{ $module->id }}"
                                data-toggle="tab">
                                    Topik
                                </a>
                            </li>
                            <!-- TOPIC -->

                            <li class="nav-item">
                                <a
                                class="nav-link"
                                href=
                                "#{{ strtok($module->description, " ") }}{{ $module->id }}"
                                data-toggle="tab">
                                    Description
                                </a>
                            </li>
                            <!-- DESCRIPTION -->

                            <li class="nav-item">
                                <a
                                class="nav-link"
                                href=
                                "#{{ strtok(str_replace("file/", "", $module->file), ".") }}{{ $module->id }}"
                                data-toggle="tab">
                                    Bahan Ajar
                                </a>
                            </li>
                            <!-- FILE MODUL -->

                            <li class="nav-item">
                                <a
                                class="nav-link"
                                href=
                                "#@php
                                $values = parse_url($module->reference);
                                $host = explode('.',$values['host']);
                                echo $host[0] . $module->id;
                                @endphp"
                                data-toggle="tab">
                                    Referensi
                                </a>
                            </li>
                            <!-- LINK REFERENCE -->

                        </ul>
                        <!-- /.card-tools -->
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <div class="tab-content">
                            <div
                            class="tab-pane active"
                            id="{{ strtok($module->topic, " ") }}{{ $module->id }}">
                                {{ $module->topic }}
                            </div>
                            <!-- /.tab-pane TOPIC -->

                            <div
                            class="tab-pane"
                            id="{{ strtok($module->description, " ") }}{{ $module->id }}">
                                {{ $module->description }}
                            </div>
                            <!-- /.tab-pane DESCRIPTION -->

                            <div
                            class="tab-pane"
                            id="{{ strtok(str_replace("file/", "", $module->file), ".") }}{{ $module->id }}">
                                <a href="/storage/{{ $module->file }}">
                                    {{ str_replace("file/", "", $module->file) }}
                                </a>
                            </div>
                            <!-- /.tab-pane FILE MODUL -->

                            <div
                            class="tab-pane"
                            id="@php
                            $values = parse_url($module->reference);
                            $host = explode('.',$values['host']);
                            echo $host[0] . $module->id;
                            @endphp">
                                <a href="{{ $module->reference }}">{{ $module->reference }}</a>
                            </div>
                            <!-- /.tab-pane LINK REFERENCE -->

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
