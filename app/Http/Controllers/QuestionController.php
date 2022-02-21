<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    // public function show(Quiz $quiz)
    // {
    //     return view('quizzes.show', [
    //         'title' => 'Show Quiz',
    //         'quiz' => $quiz,
    //     ]);
    // }

    public function create(Quiz $quiz)
    {
        return view('questions.create', [
            'title' => 'Tambah soal',
            'quiz' => $quiz,
        ]);
    }

    public function store()
    {
        request()->validate([
            'quiz_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2058',
        ]);

        $question = Question::create([
            'quiz_id' => request('quiz_id'),
            'question' => request('question'),
            'answer' => request('answer'),
            'note' => request('note'),
            'image' => request('image') ? request()->file('image')->store('img/questions') : null,
        ]);

        if (count(request('choice')) > 0) {
            foreach (request('choice') as $index => $value) {
                $data = [
                    'question_id' => $question->id,
                    'choice' => request('choice')[$index],
                ];
                Choice::create($data);
            }
        }

        toast('Soal berhasil ditambahkan!', 'success');
        return redirect()->route('quizzes.index', auth()->user()->teacher_id);
    }

    public function edit(Quiz $quiz, Question $question)
    {
        // dd($question->find(3)->choices()->get());
        return view('questions.edit', [
            'title' => 'Edit Soal',
            'quiz' => $quiz,
            'question' => $question,
        ]);
    }

    public function destroy(Question $question)
    {
        Storage::delete($question->image);
        $question->delete();
        toast('Soal berhasil dihapus!', 'success');
        return redirect()->back();
    }
}
