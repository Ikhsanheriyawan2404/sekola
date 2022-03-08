<?php

namespace App\Http\Controllers;

use App\Models\{Student, Teacher, Classroom, Finance, Study, Major, Room, Setting, Schedule, Result, Quiz};

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:dashboard-admin', ['only' => ['admin']]);
        $this->middleware('permission:dashboard-student', ['only' => ['student']]);
        $this->middleware('permission:dashboard-teacher', ['only' => ['teacher']]);
    }

    // Home
    public function index()
    {
        return view('home', [
            'title' => 'Home',
            'school' => Setting::find(1),
        ]);
    }

    // Dashboard untuk siswa
    public function student(Student $student)
    {
        $quizzes = Quiz::all();
        $results = Result::all();

        return view('dashboard', [
            'title' => 'Dashboard',
            'student' => $student,
            'results' => $results,
            'quizzes' => $quizzes,
            'schedules' => Schedule::with('classroom', 'teacher', 'study', 'room')->get(),
        ]);
    }

    // Dashboard untuk guru
    public function teacher(Teacher $teacher)
    {
        return view('dashboard_teacher', [
            'title' => 'Dashboard',
            'teacher' => $teacher,
            'classrooms' => Classroom::all(),
            'schedules' => Schedule::with('classroom', 'study', 'room', 'teacher')->get(),
        ]);
    }

    // Dashboard untuk admin & operator
    public function admin()
    {
        return view('dashboard_admin', [
            'title' => 'Dashboard',
            'finances' => Finance::all(),
            'students' => Student::all(),
            'teachers' => Teacher::all(),
            'classrooms' => Classroom::all(),
            'studies' => Study::all(),
            'majors' => Major::all(),
            'rooms' => Room::all(),
        ]);
    }
}
