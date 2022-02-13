<?php

namespace App\Http\Controllers;

use App\Models\{Major, Study};
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
            'study' => new Study(),
            'majors' => Major::all(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|max:255|unique:studies,name,',
            'type' => 'required',
            'major_id' => 'required',
        ]);

        Study::create([
            'name' => request('name'),
            'study_code' => request('study_code'),
            'type' => request('type'),
            'major_id' => request('major_id'),
        ]);

        toast('Data mapel berhasil ditambahkan!', 'success');
        return redirect()->route('studies.index');
    }

    public function edit(Study $study)
    {
        return view('studies.edit', [
            'title' => 'Edit Mata Pelajaran' . $study->name,
            'study' => $study,
            'majors' => Major::all(),
        ]);
    }

    public function update(Study $study)
    {
        request()->validate([
            'name' => 'required|max:255|unique:studies,name,' . $study->id,
            'type' => 'required',
            'major_id' => 'required',
        ]);

        $study->update([
            'name' => request('name'),
            'study_code' => request('study_code'),
            'type' => request('type'),
            'major_id' => request('major_id'),
        ]);

        toast('Data mapel berhasil diedit!', 'success');
        return redirect()->route('studies.index');
    }

    public function destroy(Study $study)
    {
        $study->delete();
    }
}
