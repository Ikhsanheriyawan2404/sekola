<?php

namespace App\Http\Controllers;

use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index', [
            'title' => 'Siswa',
            'students' => Student::all(),
        ]);
    }

    public function create()
    {
        return view('students.create', [
            'title' => 'Tambah Siswa',
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required', 'max:255'],
            'nisn' => ['required', 'max:255'],
            'religion' => ['required'],
            'gender' => ['required'],
            'date_of_birth' => ['required'],
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2058',
            'phone' => ['required'],
        ]);

        Student::create([
            'name' => request('name'),
            'nisn' => request('nisn'),
            'gender' => request('gender'),
            'religion' => request('religion'),
            'date_of_birth' => request('date_of_birth'),
            'phone' => request('phone'),
            'photo' => request('photo') ? request()->file('photo')->store('img/student') : null,
            'address' => request('address'),
        ]);

        toast('Data siswa berhasil dibuat!','success');
        return redirect()->route('students.index');
    }
}
