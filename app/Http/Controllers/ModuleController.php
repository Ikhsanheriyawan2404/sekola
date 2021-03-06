<?php

namespace App\Http\Controllers;

use App\Http\Requests\{ModuleStoreRequest, ModuleUpdateRequest};
use Illuminate\Support\Facades\Storage;
use App\Models\{Module, Study, Classroom, Student, Teacher, Schedule};

class ModuleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:module-list|module-create|module-edit|module-delete', ['only' => ['index','show']]);
        $this->middleware('permission:module-create', ['only' => ['create','store']]);
        $this->middleware('permission:module-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:module-delete', ['only' => ['destroy']]);
    }

    public function index(Student $student)
    {
        return view('modules.index', [
            'title' => 'Materi Mata Pelajaran',
            'student' => $student,
            'classrooms' => Classroom::all(),
            'schedules' => Schedule::with('study')->get(),
        ]);
    }

    public function show(Study $study)
    {
        return view('modules.show', [
            'title' => 'Detail Materi',
            'study' => $study,
            'modules' => Module::all(),
        ]);
    }

    public function create(Study $study, $id, Teacher $teacher)
    {
        if ($teacher->id == auth()->user()->teacher_id) {
            $classroom = Classroom::find($id);
            return view('modules.create', [
                'title' => 'Tambah Modul',
                'module' => new Module(),
                'study' => $study,
                'classroom' => $classroom,
                'teacher' => $teacher,
            ]);
        } else {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }
    }

    public function store(ModuleStoreRequest $request)
    {
        $request->validated();

        if (request('file')) {
            $filename = str_replace(' ', '', request()->file('file')->getClientOriginalName());
            $file = request()->file('file')->storeAs('file', $filename);
        } else {
            $file = null;
        }

        Module::create([
            'title' => request('title'),
            'topic' => request('topic'),
            'description' => request('description'),
            'file' => $file,
            'reference' => request('reference'),
            'teacher_id' => request('teacher_id'),
            'study_id' => request('study_id'),
            'classroom_id' => request('classroom_id'),
        ]);

        toast('Modul berhasil ditambahkan!', 'success');
        return redirect()->route('teacher.dashboard', auth()->user()->teacher_id);
    }

    public function edit(Module $module, $id)
    {
        $teacher = Teacher::find($id);
        if ($teacher->id == auth()->user()->teacher_id) {
            return view('modules.edit', [
                'title' => 'Edit Modul',
                'module' => $module,
                'teacher' => $teacher,
            ]);
        } else {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }
    }

    public function update(Module $module, ModuleUpdateRequest $request)
    {
        $request->validated();

        if (request('file')) {
            Storage::delete($module->file);
            $filename = str_replace(' ', '', request()->file('file')->getClientOriginalName());
            $file = request()->file('file')->storeAs('file', $filename);
        } else if ($module->file) {
            $file = $module->file;
        } else {
            $file = null;
        }

        $module->update([
            'title' => request('title'),
            'topic' => request('topic'),
            'description' => request('description'),
            'file' => $file,
            'reference' => request('reference'),
        ]);

        toast('Modul berhasil diedit!', 'success');
        return redirect()->route('teacher.dashboard', auth()->user()->teacher_id);
    }

    public function destroy(Module $module)
    {
        Storage::delete($module->file);
        $module->delete();

        toast('Data modul berhasil dihapus!','success');
        return redirect()->back();
    }
}
