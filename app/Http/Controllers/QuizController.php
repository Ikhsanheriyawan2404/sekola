<?php

namespace App\Http\Controllers;


class QuizController extends Controller
{
    public function index()
    {
        return view('quizzes.index', [
            'title' => 'Quiz',
        ]);
    }

    public function create()
    {
        return view('quizzes.create', [
            'title' => 'Tambah Ulangan',
        ]);
    }

    public function store()
    {

    }
}
