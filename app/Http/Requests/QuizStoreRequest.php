<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'date' => 'required',
            'start' => 'required',
            'finished' => 'required',
            'time' => 'required',
            'number_of_questions' => 'required',
            'classroom_id' => 'required',
            'teacher_id' => 'required',
            'study_id' => 'required',
        ];
    }
}
