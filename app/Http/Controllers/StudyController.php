<?php

namespace App\Http\Controllers;

use App\Models\Study;
use Yajra\DataTables\Facades\DataTables;

class StudyController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $study = Study::latest()->get();
            return DataTables::of($study)
                    ->addIndexColumn()
                    ->addColumn('major', function (Study $study) {
                        return $study->major->name;
                    })
                    ->addColumn('action', function($row){
                        $btn =
                        '<div class="d-flex justify-content-center">

                            <a href=" ' . route('studies.edit', $row->id) . '" class="btn btn-sm btn-primary mr-2"><i class="fas fa-pencil-alt"></i></a>

                            <a href="javascript:void(0)" data-id="' . $row->id . '" id="deleteClassroom" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>

                        </div>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('studies.index', [
            'title' => 'Mata Pelajaran',
        ]);
    }

    public function create()
    {
        return view('studies.create', [
            'title' => 'Tambah Mata Pelajaran',
            'classroom' => new Study(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|max:255|unique:classrooms,name,',
            'major_id' => 'required',
            'teacher_id' => 'required',
        ]);

        Study::create([
            'name' => request('name'),
            'major_id' => request('major_id'),
            'teacher_id' => request('teacher_id'),
        ]);

        toast('Data mata pelajaran berhasil ditambahkan!', 'success');
        return redirect()->route('studies.index');
    }

    public function edit(Study $study)
    {
        return view('studies.edit', [
            'title' => 'Edit Mata Pelajaran' . $study->name,
            'study' => $study,
        ]);
    }

    public function update(Study $study)
    {
        request()->validate([
            'name' => 'required|max:255|unique:classrooms,name,' . $classroom->id,
            'major_id' => 'required',
            'teacher_id' => 'required',
        ]);

        $classroom->update([
            'name' => request('name'),
            'major_id' => request('major_id'),
            'teacher_id' => request('teacher_id'),
        ]);

        toast('Data kelas berhasil diedit!', 'success');
        return redirect()->route('classrooms.index');
    }

    public function destroy(Study $study)
    {
        $study->delete();
    }
}
