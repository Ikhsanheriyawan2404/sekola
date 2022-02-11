<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Student;
use Yajra\DataTables\Facades\DataTables;

class ClassroomController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $classrooms = Classroom::latest()->get();
            return DataTables::of($classrooms)
                    ->addIndexColumn()
                    ->addColumn('teacher', function (Classroom $classroom) {
                        return $classroom->teacher->name;
                    })
                    ->addColumn('major', function (Classroom $classroom) {
                        return $classroom->major->name;
                    })
                    ->addColumn('action', function($row){
                        $btn =
                        '<div class="d-flex justify-content-center">

                            <a href="javascript:void(0)" data-id="'.$row->id.'" id="showStudents" class="btn btn-sm btn-primary mr-2">
                            <i class="fas fa-eye"></i>
                            Siswa
                            </a>

                            <a href="javascript:void(0)" data-id="'.$row->id.'" id="showSchedule" class="btn btn-sm btn-primary mr-2">
                            <i class="fas fa-eye"></i>
                            Jadwal
                            </a>

                            <a href=" ' . route('classrooms.edit', $row->id) . '" class="btn btn-sm btn-primary mr-2"><i class="fas fa-pencil-alt"></i></a>

                            <a href="javascript:void(0)" data-id="' . $row->id . '" id="deleteClassroom" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>

                        </div>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('classrooms.index', [
            'title' => 'Kelas',
        ]);
    }

    public function create()
    {
        return view('classrooms.create', [
            'title' => 'Tambah Kelas',
            'classroom' => new Classroom(),
            'teachers' => Teacher::all(),
            'majors' => Major::all(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|max:255|unique:classrooms,name,',
            'major_id' => 'required',
            'teacher_id' => 'required',
        ]);

        Classroom::create([
            'name' => request('name'),
            'major_id' => request('major_id'),
            'teacher_id' => request('teacher_id'),
        ]);

        toast('Data kelas berhasil ditambahkan!', 'success');
        return redirect()->route('classrooms.index');
    }

    public function edit(Classroom $classroom)
    {
        return view('classrooms.edit', [
            'title' => 'Edit Kelas',
            'classroom' => $classroom,
            'teachers' => Teacher::all(),
            'majors' => Major::all(),
        ]);
    }

    public function update(Classroom $classroom)
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

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
    }

    public function showStudent(Student $student)
    {
        return response()->json($student);
    }
}
