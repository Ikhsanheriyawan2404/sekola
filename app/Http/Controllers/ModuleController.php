<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Study;
use App\Models\Module;
use App\Models\Schedule;

class ModuleController extends Controller
{
    public function create(Study $study, Classroom $classroom)
    {
        // $classroom = Classroom::find($classroom);
        return view('modules.create', [
            'title' => 'Tambah Modul',
            'module' => new Module(),
            'study' => $study,
            'classroom' => $classroom,
        ]);
    }

    public function store()
    {
        // request()->validate();
        dd(Module::create([
            'title' => request('title'),
            'topic' => request('topic'),
            'description' => request('description'),
            'modul' => request('modul'),
            'reference' => request('reference'),
            'teacher_id' => auth()->user()->teacher_id,
            'studies_id' => 1,
            'classroom_id' => 1,
        ]));
    }
}
