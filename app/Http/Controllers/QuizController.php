<?php

namespace App\Http\Controllers;

use App\Models\{Quiz, Question, Study, Classroom, Teacher, Result};
use App\Http\Requests\{QuizStoreRequest, QuizUpdateRequest};

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:quiz-list|quiz-create|quiz-edit|quiz-delete', ['only' => ['index','show']]);
        $this->middleware('permission:quiz-create', ['only' => ['create','store']]);
        $this->middleware('permission:quiz-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:quiz-delete', ['only' => ['destroy']]);
    }

    public function index(Teacher $teacher)
    {
        return view('quizzes.index', [
            'title' => 'Quiz',
            'teacher' => $teacher,
            'quizzes' => Quiz::with('study', 'teacher', 'classroom')->get(),
        ]);
    }

    public function show(Quiz $quiz)
    {
        $questions = Question::with('choices')->where('quiz_id', $quiz->id)->get();
        return view('quizzes.show', [
            'title' => 'Show Quiz',
            'quiz' => $quiz,
            'questions' => $questions,
        ]);
    }

    public function create(Study $study, $id)
    {
        $classroom = Classroom::findOrFail($id);
        return view('quizzes.create', [
            'title' => 'Tambah Ulangan',
            'quiz' => new Quiz(),
            'study' => $study,
            'classroom' => $classroom,
        ]);
    }

    public function store(QuizStoreRequest $request)
    {
        $request->validated();

        Quiz::create([
            'title' => request('title'),
            'date' => request('date'),
            'start' => request('start'),
            'finished' => request('finished'),
            'time' => request('time'),
            'number_of_questions' => request('number_of_questions'),
            'classroom_id' => request('classroom_id'),
            'teacher_id' => request('teacher_id'),
            'study_id' => request('study_id'),
        ]);

        toast('Data ulangan berhasil ditambahkan!', 'success');
        return redirect()->route('quizzes.index', auth()->user()->teacher_id);
    }

    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit', [
            'title' => 'Edit Ulangan',
            'quiz' => $quiz,
        ]);
    }

    public function update(QuizUpdateRequest $request, Quiz $quiz)
    {
        $request->validated();

        $quiz->update([
            'title' => request('title'),
            'date' => request('date'),
            'start' => request('start'),
            'finished' => request('finished'),
            'time' => request('time'),
            'number_of_questions' => request('number_of_questions'),
        ]);

        toast('Data ulangan berhasil diedit!', 'success');
        return redirect()->route('quizzes.index', auth()->user()->teacher_id);
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        toast('Ulangan berhasil dihapus!', 'success');
        return redirect()->back();
    }

    public function changeStatus(Quiz $quiz)
    {
        $quiz->update([
            'status' => request('status'),
        ]);

        toast('Status ulangan berhasil diubah!', 'success');
        return redirect()->back();
    }

    public function result(Quiz $quiz)
    {
        $results = Result::with('student', 'quiz')->where('quiz_id', $quiz->id)->get();
        return view('quizzes.result', [
            'title' => 'Hasil ujian',
            'quiz' => $quiz,
            'results' => $results,
        ]);
    }
}
