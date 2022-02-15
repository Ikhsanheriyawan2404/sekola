<?php

namespace App\Http\Controllers;

use App\Models\{Module, Study, Classroom};

class ModuleController extends Controller
{
    public function create(Study $study, $id)
    {
        $classroom = Classroom::find($id);
        return view('modules.create', [
            'title' => 'Tambah Modul',
            'module' => new Module(),
            'study' => $study,
            'classroom' => $classroom,
        ]);
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'modul' => 'file|mimes:pdf,docx,pptx,xlsx|max:4096',
            'study_id' => 'required',
            'classroom_id' => 'required',
        ]);

        if (request('modul')) {
            $filename = request()->file('modul')->getClientOriginalName();
            $file = request()->file('modul')->storeAs('file', $filename);
        } else {
            $file = null;
        }

        Module::create([
            'title' => request('title'),
            'topic' => request('topic'),
            'description' => request('description'),
            'modul' => $file,
            'reference' => request('reference'),
            'teacher_id' => auth()->user()->teacher_id,
            'studies_id' => request('study_id'),
            'classroom_id' => request('classroom_id'),
        ]);

        toast('Modul berhasil ditambahkan!', 'success');
        return redirect()->back();
    }
}
