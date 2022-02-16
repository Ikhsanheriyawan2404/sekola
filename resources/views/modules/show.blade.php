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

                <div class="card card-primary card-outline">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3">{{ $module->title }}
                            @can('module-edit')
                            <a href="{{ route('modules.edit', [$module->id, $module->teacher_id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-alt"></i> Edit</a>
                            @endcan
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
                                // if ($values['host'] !== NULL) {
                                    // $host = explode('.',$values['host']);
                                    // echo $host[0] . $module->id;
                                // }
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
                            dd(in_array(array(), $values));
                            // dd($values);
                            // if ($values['host'] !== NULL) {
                                // $host = explode('.',$values['host']);
                                // echo $host[0] . $module->id;
                            // }
                            @endphp">
                                {{ $module->reference }}
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
