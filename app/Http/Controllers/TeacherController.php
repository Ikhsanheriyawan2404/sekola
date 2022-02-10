<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $teacher = Teacher::latest()->get();
            return DataTables::of($teacher)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn =
                        '<div class="d-flex justify-content-between">

                            <a href="javascript:void(0)" data-id="'.$row->id.'" id="showItem" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>

                            <a href=" ' . route('teachers.edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>

                            <a href="javascript:void(0)" data-id="' . $row->id . '" id="deleteTeacher" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>

                        </div>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('teachers.index', [
            'title' => 'Guru',
        ]);
    }

    public function show(Teacher $teacher)
    {
        return response()->json($teacher);
    }

    public function create()
    {
        return view('teachers.create', [
            'title' => 'Tambah Guru',
            'teacher' => new Teacher,
        ]);
    }

    public function store(TeacherRequest $request)
    {
        $request->validated();

        Teacher::create([
            'name' => request('name'),
            'nip' => request('nip'),
            'gender' => request('gender'),
            'phone' => request('phone'),
            'email' => request('email'),
            'image' => request('image') ? request()->file('image')->store('img/teachers') : null,
        ]);


        toast('Data guru berhasil dibuat!','success');
        return redirect()->route('teachers.index');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        toast('Data jurusan berhasil dihapus!','success');
        return redirect()->route('majors.index');
    }
}
