<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\Question;

class ExamController extends Controller
{
    public function show(Quiz $quiz)
    {
        $questions = Question::inRandomOrder()->where('quiz_id', $quiz->id)->get();
        return view('exams.show', [
            'title' => 'Start exam',
            'quiz' => $quiz,
            'questions' => $questions,
        ]);
    }

    public function store()
    {
        $userId = auth()->user()->student_id;
        $date =date('Y-m-d');
        $yes = 0;
        $no = 0;
        $data = request()->all();

        for($i=1; $i <= request('index'); $i++)
        {
            if(isset($data['question_id'.$i])) {
            $exam=new Exam;

                $question = Question::where('id',$data['question_id'.$i])->get()->first();
                if ($question->answer == $data['answer'.$i]) {
                    $result[$data['question_id'.$i]] = 'yes';
                    $exam->answered = "yes";
                    $yes++;
                } else {
                    $result[$data['question_id'.$i]] = 'no';
                    $exam->answered = "no";
                    $no++;
                }

                $exam->student_id = $userId;
                $exam->quiz_id = $question->quiz_id;
                $exam->question_id = $data['question_id'.$i];
                $exam->answer = $data['answer'.$i];
                // dd($exam);
                $exam->save();
            }
        }

        if ($res = Result::where('student_id', $userId)->where('quiz_id', request('quiz_id'))->first())
        {

        } else {
            $res=new Result;
        }

        $res->student_id= $userId;
        $res->quiz_id = request('quiz_id');
        // $res->date = $date;
        $res->correct = $yes;
        $res->wrong = $no;
        $res->save();

        toast('Ulangan berhasil diselesaikan!', 'success');
        return redirect()->route('student.dashboard', auth()->user()->student_id);
    }
}