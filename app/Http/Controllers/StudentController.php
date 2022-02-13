<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;

class StudentController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $students = Student::get();
            return DataTables::of($students)
                    ->addIndexColumn()
                    ->addColumn('classroom', function(Student $student) {
                        return $student->classroom->name;
                    })
                    ->editColumn('gender', function($request) {
                        return $request->gender == 'L' ? 'Laki-Laki' : 'Perempuan';
                    })
                    ->addColumn('action', function($row){
                        $btn =
                        '<div class="d-flex justify-content-between">

                            <a href="javascript:void(0)" data-id="'.$row->id.'" id="showItem" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>


                           <a href=" ' . route('students.edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>


                           <form action=" ' . route('students.destroy', $row->id) . '" method="POST">
                               <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah yakin ingin menghapus ini?\')"><i class="fas fa-trash"></i></button>
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                           </form>
                        </div>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('students.index', [
            'title' => 'Siswa',
        ]);
    }

    public function show(Student $student)
    {
        return response()->json($student);
    }

    public function create()
    {
        return view('students.create', [
            'title' => 'Tambah Siswa',
            'student' => new Student,
            'classrooms' => Classroom::all(),
        ]);
    }

    public function store(StudentStoreRequest $request)
    {

        $request->validated();

        Student::create([
            'name' => request('name'),
            'nisn' => request('nisn'),
            'gender' => request('gender'),
            'religion' => request('religion'),
            'date_of_birth' => request('date_of_birth'),
            'phone' => request('phone'),
            'image' => request('image') ? request()->file('image')->store('img/students') : null,
            'address' => request('address'),
            'classroom_id' => request('classroom_id'),
        ]);


        toast('Data siswa berhasil dibuat!','success');
        return redirect()->route('students.index');
    }

    public function edit(Student $student)
    {
        return view('students.edit', [
            'title' => 'Edit Siswa',
            'student' => $student,
            'classrooms' => Classroom::all(),
        ]);
    }

    public function update(Student $student, StudentUpdateRequest $request)
    {
        $request->validated();

        if (request('image')) {
            Storage::delete($student->image);
            $image = request()->file('image')->store('img/student');
        } elseif ($student->image) {
            $image = $student->image;
        } else {
            $image = null;
        }

        $student->update([
            'name' => request('name'),
            'nisn' => request('nisn'),
            'gender' => request('gender'),
            'religion' => request('religion'),
            'date_of_birth' => request('date_of_birth'),
            'phone' => request('phone'),
            'image' => $image,
            'address' => request('address'),
            'classroom_id' => request('classroom_id'),
        ]);

        toast('Data siswa berhasil diedit!','success');
        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        Storage::delete($student->image);
        $student->delete();
        toast('Data siswa berhasil dihapus!','success');
        return redirect()->route('students.index');
    }
}
