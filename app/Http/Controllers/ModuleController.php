<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function create()
    {
        return view('modules.create', [
            'title' => 'Tambah Modul',
            'module' => new Module(),
        ]);
    }

    public function store()
    {
        request()->validate();
    }
}
