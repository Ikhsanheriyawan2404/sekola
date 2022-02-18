<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'date', 'start', 'finished', 'time', 'number_of_questions', 'status', 'teacher_id', 'study_id'];

}
