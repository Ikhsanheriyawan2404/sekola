<?php

namespace App\Http\Controllers;

use App\Models\{Student, Teacher, Classroom, Study, Major, Room};

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home');
    }

    public function index()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
            'students' => Student::all(),
            'teachers' => Teacher::all(),
            'classrooms' => Classroom::all(),
            'studies' => Study::all(),
            'majors' => Major::all(),
            'rooms' => Room::all(),
        ]);
    }
}
