<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $students = Student::all();
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

    public function create()
    {
        return view('students.create', [
            'title' => 'Tambah Siswa',
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required', 'max:255'],
            'nisn' => ['required', 'max:255'],
            'religion' => ['required'],
            'gender' => ['required'],
            'date_of_birth' => ['required'],
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2058',
            'phone' => ['required'],
        ]);

        Student::create([
            'name' => request('name'),
            'nisn' => request('nisn'),
            'gender' => request('gender'),
            'religion' => request('religion'),
            'date_of_birth' => request('date_of_birth'),
            'phone' => request('phone'),
            'photo' => request('photo') ? request()->file('photo')->store('img/student') : null,
            'address' => request('address'),
        ]);

        toast('Data siswa berhasil dibuat!','success');
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
