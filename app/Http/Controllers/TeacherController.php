<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\{Study, Teacher};
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\TeacherRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:teacher-list|teacher-create|teacher-edit|teacher-delete', ['only' => ['index','show']]);
        $this->middleware('permission:teacher-create', ['only' => ['create','store']]);
        $this->middleware('permission:teacher-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:teacher-delete', ['only' => ['destroy']]);
    }

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
            'teachers' => Teacher::all(),
        ]);
    }

    public function show(Teacher $teacher)
    {
        $study_teacher = $teacher->studies()->get();
        return response()->json($study_teacher);
    }

    public function create()
    {
        return view('teachers.create', [
            'title' => 'Tambah Guru',
            'teacher' => new Teacher,
            'studies' => Study::all(),
        ]);
    }

    public function store(TeacherRequest $request)
    {
        $request->validated();

        $teacher = Teacher::create([
            'name' => request('name'),
            'nip' => request('nip'),
            'gender' => request('gender'),
            'phone' => request('phone'),
            'email' => request('email'),
            'image' => request('image') ? request()->file('image')->store('img/teachers') : null,
        ]);

        $teacher->studies()->sync(request('studies'));

        $user = User::create([
            'name' => $teacher['name'],
            'email' => $teacher['email'],
            'password' => Hash::make($teacher['nip']),
            'teacher_id' => $teacher['id'],
        ]);

        $user->assignRole('Guru');

        toast('Data guru berhasil dibuat!','success');
        return redirect()->route('teachers.index');
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', [
            'title' => "Edit Guru",
            'teacher' => $teacher,
            'studies' => Study::all(),
        ]);
    }

    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $request->validated();

        if (request('image')) {
            Storage::delete($teacher->image);
            $image = request()->file('image')->store('img/teachers');
        } elseif ($teacher->image) {
            $image = $teacher->image;
        } else {
            $image = null;
        }

        $teacher->update([
            'name' => request('name'),
            'nip' => request('nip'),
            'gender' => request('gender'),
            'phone' => request('phone'),
            'email' => request('email'),
            'image' => $image,
        ]);

        $teacher->studies()->sync(request('studies'));

        toast('Data guru berhasil diedit!','success');
        return redirect()->route('teachers.index');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        toast('Data jurusan berhasil dihapus!','success');
        return redirect()->route('majors.index');
    }

    public function export()
    {
        return Excel::download(new TeacherExport, 'student.xlsx');
    }

    public function import()
    {
        request()->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        Excel::import(new TeacherImport, request()->file('file')->store('file'));

        toast('Data guru berhasil diimport!', 'success');
        return redirect()->route('teachers.index');
    }

    public function printPDF()
    {
        $teachers = Teacher::all();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf', compact('teachers'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
