<?php

namespace App\Http\Controllers;

use App\Models\{Exam, Quiz, Result, Question};

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:exam-list|exam-create|exam-edit|exam-delete', ['only' => ['index','show']]);
        $this->middleware('permission:exam-create', ['only' => ['create','store']]);
    }

    public function show(Quiz $quiz)
    {
        $questions = Question::inRandomOrder()->where('quiz_id', $quiz->id)->get();
        if ($quiz->status == '1') {
            return view('exams.show', [
                'title' => 'Start exam',
                'quiz' => $quiz,
                'questions' => $questions,
            ]);
        } else {
            abort(403, 'THIS QUIZ HAS NOT BEEN ACTIVATED. TELL YOUR TEACHER!');
        }
    }

    public function store()
    {
        $userId = auth()->user()->student_id;
        $correctAnswer = 0;
        $wrongAnswer = 0;
        $data = request()->all();

        for($i=1; $i <= request('index'); $i++)
        {
            if(isset($data['question_id'.$i])) {
            $exam=new Exam;

                $question = Question::where('id',$data['question_id'.$i])->get()->first();
                if ($question->answer == $data['answer'.$i]) {
                    $result[$data['question_id'.$i]] = 'yes';
                    $exam->answered = "yes";
                    $correctAnswer++;
                } else {
                    $result[$data['question_id'.$i]] = 'no';
                    $exam->answered = "no";
                    $wrongAnswer++;
                }

                $exam->student_id = $userId;
                $exam->quiz_id = $question->quiz_id;
                $exam->question_id = $data['question_id'.$i];
                $exam->answer = $data['answer'.$i];
                $exam->save();
            }
        }

        $res = Result::where('student_id', $userId)->where('quiz_id', request('quiz_id'))->first();

        $res->student_id= $userId;
        $res->quiz_id = request('quiz_id');
        $res->correct = $correctAnswer;
        $res->wrong = $wrongAnswer;
        $res->save();

        toast('Ulangan berhasil diselesaikan!', 'success');
        return redirect()->route('student.dashboard', auth()->user()->student_id);
    }
}
