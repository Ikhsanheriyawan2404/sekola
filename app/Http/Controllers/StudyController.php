<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StudyStoreRequest, StudyUpdateRequest};
use App\Models\{Major, Study};
use Yajra\DataTables\Facades\DataTables;

class StudyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:study-list|study-create|study-edit|study-delete', ['only' => ['index','show']]);
        $this->middleware('permission:study-create', ['only' => ['create','store']]);
        $this->middleware('permission:study-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:study-delete', ['only' => ['destroy']]);
        $this->middleware('permission:study-print', ['only' => ['export', 'import', 'printPDF',]]);
        $this->middleware('permission:study-trash', ['only' => ['trash', 'restore', 'deletePermanent', 'deleteAll',]]);
    }

    public function index()
    {
        if (request()->ajax()) {
            $study = Study::with('major')->latest()->get();
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

    public function store(StudyStoreRequest $request)
    {
        $request->validated();

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
            'title' => 'Edit Mata Pelajaran : ' . $study->name,
            'study' => $study,
            'majors' => Major::all(),
        ]);
    }

    public function update(Study $study, StudyUpdateRequest $request)
    {
        $request->validated();

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

    public function trash()
    {
        $studies = Study::onlyTrashed()->get();
    	return view('studies.trash', [
            'title' => 'Trash Mata Pelajaran',
            'studies' => $studies,
        ]);
    }

    public function restore($id)
    {
        $study = Study::onlyTrashed()->where('id', $id);
        $study->restore();
        toast('Data mapel berhasil dipulihkan!', 'success');
    	return redirect()->back();
    }

    public function deletePermanent($id)
    {
        $study = Study::onlyTrashed()->where('id', $id);
    	$study->forceDelete();

        toast('Data mapel berhasil dihapus permanen!', 'success');
    	return redirect()->back();
    }

    public function deleteAll()
    {
        $studies = Study::onlyTrashed();
        $studies->forceDelete();

        toast('Semua data mapel berhasil dihapus permanen!', 'success');
    	return redirect()->back();
    }
}
