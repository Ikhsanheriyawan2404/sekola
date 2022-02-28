<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherUpdateRequest extends FormRequest
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
            'nip' => 'required|unique:teachers,nip,' . $this->teacher->id,
            'gender' => ['required'],
            'image' => 'image|mimes:jpg,jpeg,png|max:2058',
            'studies' => 'required|array',
            'email' => 'required|max:255|unique:teachers,email,' . $this->teacher->id,
        ];
    }
}
