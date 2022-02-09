<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Yajra\DataTables\Facades\DataTables;

class MajorController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $students = Major::latest()->get();
            return DataTables::of($students)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn =
                        '<div class="d-flex justify-content-between">

                           <a href="javascript:void(0)" data-id="' . $row->id . '" id="editMajor" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>

                           <a href="javascript:void(0)" data-id="' . $row->id . '" id="deleteMajor" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>

                        </div>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('majors.index', [
            'title' => 'Jurusan',
        ]);
    }

    public function store()
    {
        request()->validate(['name' => 'required']);

        Major::updateOrCreate(
            ['id' => request('majorId')],
            ['name' => request('name')]);
    }

    public function edit(Major $major)
    {
        return response()->json($major);
    }

    public function destroy(Major $major)
    {
        $major->delete();
        toast('Data jurusan berhasil dihapus!','success');
        return redirect()->route('majors.index');
    }
}
