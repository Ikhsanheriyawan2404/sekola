<?php

namespace App\Http\Controllers;

use App\Models\{Student, Teacher, Classroom, Study, Major, Room, Setting};

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'title' => 'Home',
            'school' => Setting::find(1),
        ]);
    }

    public function home()
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

    public function admin()
    {
        return view('dashboard_admin', [
            'title' => 'Dashboard',
            'students' => Student::all(),
            'teachers' => Teacher::all(),
            'classrooms' => Classroom::all(),
            'studies' => Study::all(),
            'majors' => Major::all(),
            'rooms' => Room::all(),
        ]);
    }

    public function teacher()
    {
        return view('dashboard_teacher', [
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
