<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(Quiz $quiz)
    {
        return view('questions.create', [
            'title' => 'Tambah soal',
            'quiz' => $quiz,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);

        $question = Question::create([
            'quiz_id' => request('quiz_id'),
            'question' => request('question'),
            'answer' => request('answer'),
            'note' => request('note'),
            'image' => request('image'),
        ]);

        if (count($request->choice) > 0) {
            foreach ($request->choice as $item => $v) {
                $data = [
                    'question_id' => $question->id,
                    'choice' => $request->choice[$item],
                ];
                $choice = Choice::create($data);
            }
        }

        toast('Soal berhasil ditambahkan!', 'success');
        return redirect()->route('quizzes.index', auth()->user()->teacher_id);
    }
}
