<?php

namespace App\Http\Controllers;

use App\Models\{Module, Study, Classroom};
use Illuminate\Support\Facades\Storage;

class ModuleController extends Controller
{
    public function show(Study $study)
    {
        return view('modules.show', [
            'title' => 'Detail Materi',
            'study' => $study,
            'modules' => Module::all(),
        ]);
    }

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
            $filename = str_replace(' ', '', request()->file('modul')->getClientOriginalName());
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

    public function edit(Module $module)
    {
        return view('modules.edit', [
            'title' => 'Edit Modul',
            'module' => $module,
        ]);
    }

    public function update(Module $module)
    {
        request()->validate([
            'title' => 'required',
            'modul' => 'file|mimes:pdf,docx,pptx,xlsx|max:4096',
        ]);

        if (request('modul')) {
            Storage::delete($module->modul);
            $filename = str_replace(' ', '', request()->file('modul')->getClientOriginalName());
            $file = request()->file('modul')->storeAs('file', $filename);
        } else if ($module->modul) {
            $file = $module->modul;
        } else {
            $file = null;
        }

        $module->update([
            'title' => request('title'),
            'topic' => request('topic'),
            'description' => request('description'),
            'modul' => $file,
            'reference' => request('reference'),
        ]);

        toast('Modul berhasil diedit!', 'success');
        return redirect()->back();
    }

    public function destroy(Module $module)
    {
        Storage::delete($module->modul);
        $module->delete();

        toast('Data siswa berhasil dihapus!','success');
        return redirect()->back();
    }
}
