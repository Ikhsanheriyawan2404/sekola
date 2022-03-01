<?php

namespace App\Http\Controllers;

use App\Exports\TeacherExport;
use App\Imports\TeacherImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\{TeacherStoreRequest, TeacherUpdateRequest};
use App\Models\{User, Study, Teacher};
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
        $this->middleware('permission:teacher-print', ['only' => ['export', 'import', 'printPDF',]]);
        $this->middleware('permission:teacher-trash', ['only' => ['trash', 'restore', 'deletePermanent', 'deleteAll',]]);
    }

    public function index()
    {
        if (request()->ajax()) {
            $teacher = Teacher::latest()->get();
            return DataTables::of($teacher)
                    ->addIndexColumn()
                    ->editColumn('gender', function ($request) {
                        return $request->gender == 'L' ? 'Laki-Laki' : 'Perempuan';
                    })
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
        // show data mata pelajaran yang diajar guru
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

    public function store(TeacherStoreRequest $request)
    {
        $request->validated();

        $teacher = Teacher::create([
            'name' => request('name'),
            'nip' => request('nip'),
            'gender' => request('gender'),
            'phone' => request('phone'),
            'email' => request('email'),
            'image' => request('image') ? request()->file('image')->store('img/teachers') : 'img/default.jpg',
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

    public function update(TeacherUpdateRequest $request, Teacher $teacher)
    {
        $request->validated();

        if (request('image')) {
            if ($teacher->image == 'img/default.jpg') {
                $image = request()->file('image')->store('img/teachers');
            } else {
                Storage::delete($teacher->image);
                $image = request()->file('image')->store('img/teachers');
            }
        } elseif ($teacher->image) {
            $image = $teacher->image;
        } else {
            $image = 'img/default.jpg';
        }

        $teacher->update([
            'name' => request('name'),
            'nip' => request('nip'),
            'gender' => request('gender'),
            'phone' => request('phone'),
            'email' => request('email'),
            'image' => $image,
        ]);

        // Memasukan data relation guru dan mata pelajaran ke tabel study_teacher
        $teacher->studies()->sync(request('studies'));

        toast('Data guru berhasil diedit!','success');
        return redirect()->route('teachers.index');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->image !== 'img/default.jpg') {
            Storage::delete($teacher->image);
        }

        $teacher->delete();
        toast('Data jurusan berhasil dihapus!','success');
        return redirect()->route('majors.index');
    }

    public function trash()
    {
        $teachers = Teacher::onlyTrashed()->get();
    	return view('teachers.trash', [
            'title' => 'Trash Guru',
            'teachers' => $teachers,
        ]);
    }

    public function restore($id)
    {
        $teacher = Teacher::onlyTrashed()->where('id', $id);
        $teacher->restore();
        toast('Data guru berhasil dipulihkan!', 'success');
    	return redirect()->back();
    }

    public function deletePermanent($id)
    {
        $teacher = Teacher::onlyTrashed()->where('id', $id);
    	$teacher->forceDelete();

        toast('Data guru berhasil dihapus permanen!', 'success');
    	return redirect()->back();
    }

    public function deleteAll()
    {
        $teachers = Teacher::onlyTrashed();
        $teachers->forceDelete();

        toast('Semua data guru berhasil dihapus permanen!', 'success');
    	return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new TeacherExport, time() . 'teacher.xlsx');
    }

    public function import()
    {
        request()->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // dd(Excel::import(new TeacherImport, request()->file('file')->store('file')));
        Excel::import(new TeacherImport, request()->file('file')->store('file'));


        toast('Data guru berhasil diimport!', 'success');
        return redirect()->route('teachers.index');
    }

    public function printPDF()
    {
        $teachers = Teacher::all();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('teachers.pdf', compact('teachers'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
