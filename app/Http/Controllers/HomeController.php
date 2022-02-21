<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Schedule;
use App\Models\{Student, Teacher, Classroom, Study, Major, Room, Setting};

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:dashboard-admin', ['only' => ['admin']]);
        $this->middleware('permission:dashboard-student', ['only' => ['student']]);
        $this->middleware('permission:dashboard-teacher', ['only' => ['teacher']]);
    }
    public function index()
    {
        return view('home', [
            'title' => 'Home',
            'school' => Setting::find(1),
        ]);
    }

    public function student(Student $student)
    {
        $quizzes = Quiz::all();
        return view('dashboard', [
            'title' => 'Dashboard',
            'student' => $student,
            'quizzes' => $quizzes,
            'schedules' => Schedule::all(),
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

    public function teacher(Teacher $teacher)
    {
        return view('dashboard_teacher', [
            'title' => 'Dashboard',
            'teacher' => $teacher,
            'classrooms' => Classroom::all(),
            'schedules' => Schedule::all(),
        ]);
    }

}
