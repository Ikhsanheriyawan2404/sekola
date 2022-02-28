<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'nisn' => 'required|max:255|unique:students,nisn,',
            'religion' => ['required'],
            'gender' => ['required'],
            'date_of_birth' => ['required'],
            'image' => 'image|mimes:jpg,jpeg,png|max:2058',
            'phone' => ['required', 'max:255'],
            'email' => 'required|max:255|unique:students,email,',
            'classroom_id' => ['required'],
        ];
    }
}
