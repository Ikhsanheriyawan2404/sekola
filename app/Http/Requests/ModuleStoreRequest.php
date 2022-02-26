<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleStoreRequest extends FormRequest
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
            'file' => 'file|mimes:pdf,docx,pptx,xlsx|max:4096',
            'study_id' => 'required',
            'classroom_id' => 'required',
            'teacher_id' => 'required',
        ];
    }
}
