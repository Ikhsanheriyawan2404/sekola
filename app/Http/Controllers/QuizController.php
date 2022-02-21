<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Study;
use App\Models\Classroom;
use App\Http\Requests\QuizStoreRequest;
use App\Http\Requests\QuizUpdateRequest;
use App\Models\Question;
use App\Models\Teacher;

class QuizController extends Controller
{
    public function show(Quiz $quiz)
    {
        $questions = Question::where('quiz_id', $quiz->id)->get();
        return view('quizzes.show', [
            'title' => 'Show Quiz',
            'quiz' => $quiz,
            'questions' => $questions,
        ]);
    }

    public function index(Teacher $teacher)
    {
        return view('quizzes.index', [
            'title' => 'Quiz',
            'teacher' => $teacher,
            'quizzes' => Quiz::all(),
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
}
