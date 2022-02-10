<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $students = Student::get();
            return DataTables::of($students)
                    ->addIndexColumn()
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
        ]);
    }

    public function store(StudentRequest $request)
    {

        $request->validated();

        Student::create([
            'name' => request('name'),
            'nisn' => request('nisn'),
            'gender' => request('gender'),
            'religion' => request('religion'),
            'date_of_birth' => request('date_of_birth'),
            'phone' => request('phone'),
            'photo' => request('photo') ? request()->file('photo')->store('img/students') : null,
            'address' => request('address'),
        ]);


        toast('Data siswa berhasil dibuat!','success');
        return redirect()->route('students.index');
    }

    public function edit(Student $student)
    {
        return view('students.edit', [
            'title' => 'Edit Siswa',
            'student' => $student,
        ]);
    }

    public function update(Student $student, StudentRequest $request)
    {
        $request->validated();

        if (request('photo')) {
            Storage::delete($student->photo);
            $photo = request()->file('photo')->store('img/student');
        } elseif ($student->photo) {
            $photo = $student->photo;
        } else {
            $photo = null;
        }

        $student->update([
            'name' => request('name'),
            'nisn' => request('nisn'),
            'gender' => request('gender'),
            'religion' => request('religion'),
            'date_of_birth' => request('date_of_birth'),
            'phone' => request('phone'),
            'photo' => $photo,
            'address' => request('address'),
        ]);

        toast('Data siswa berhasil diedit!','success');
        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        Storage::delete($student->photo);
        $student->delete();
        toast('Data siswa berhasil dihapus!','success');
        return redirect()->route('students.index');
    }
}
