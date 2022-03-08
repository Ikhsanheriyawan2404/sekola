<?php

namespace App\Http\Controllers;

use App\Models\{Quiz, Question, Choice};
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:question-create', ['only' => ['create','store']]);
        $this->middleware('permission:question-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:question-delete', ['only' => ['destroy']]);
    }

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
            'question' => 'required|max:255',
            'answer' => 'required|max:255',
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
        return redirect()->back();
    }

    public function destroy(Question $question)
    {
        Storage::delete($question->image);
        $question->delete();
        toast('Soal berhasil dihapus!', 'success');
        return redirect()->back();
    }
}
