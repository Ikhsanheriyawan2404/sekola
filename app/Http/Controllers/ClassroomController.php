<?php

namespace App\Http\Controllers;

use App\Http\Requests\{ClassroomStoreRequest, ClassroomUpdateRequest};
use App\Models\{Classroom, Major, Teacher, Student};
use Yajra\DataTables\Facades\DataTables;

class ClassroomController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:classroom-show', ['only' => ['showStudents']]);
        $this->middleware('permission:classroom-list|classroom-create|classroom-edit|classroom-delete', ['only' => ['index','show']]);
        $this->middleware('permission:classroom-create', ['only' => ['create','store']]);
        $this->middleware('permission:classroom-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:classroom-delete', ['only' => ['destroy']]);
        $this->middleware('permission:classroom-print', ['only' => ['export', 'import', 'printPDF',]]);
        $this->middleware('permission:classroom-trash', ['only' => ['trash', 'restore', 'deletePermanent', 'deleteAll',]]);
    }

    public function index()
    {
        if (request()->ajax()) {
            $classrooms = Classroom::with('teacher', 'major')->latest()->get();
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

                            <a href="' . route('schedules.show', $row->id) . '" class="btn btn-sm btn-primary mr-2">
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

    public function store(ClassroomStoreRequest $request)
    {
        $request->validated();

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
            'title' => 'Edit Kelas : ' . $classroom->name,
            'classroom' => $classroom,
            'teachers' => Teacher::all(),
            'majors' => Major::all(),
        ]);
    }

    public function update(Classroom $classroom,ClassroomUpdateRequest $request)
    {
        $request->validated();

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

    public function showStudents($id)
    {
        $student = Student::get()->where('classroom_id', $id);
        return response()->json($student);
    }

    public function trash()
    {
        $classrooms = Classroom::onlyTrashed()->get();
    	return view('classrooms.trash', [
            'title' => 'Trash Kelas',
            'classrooms' => $classrooms,
        ]);
    }

    public function restore($id)
    {
        $classroom = Classroom::onlyTrashed()->where('id', $id);
        $classroom->restore();
        toast('Data kelas berhasil dipulihkan!', 'success');
    	return redirect()->back();
    }

    public function deletePermanent($id)
    {
        $classroom = Classroom::onlyTrashed()->where('id', $id);
    	$classroom->forceDelete();

        toast('Data kelas berhasil dihapus permanen!', 'success');
    	return redirect()->back();
    }

    public function deleteAll()
    {
        $classrooms = Classroom::onlyTrashed();
        $classrooms->forceDelete();

        toast('Semua data kelas berhasil dihapus permanen!', 'success');
    	return redirect()->back();
    }
}
