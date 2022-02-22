<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'quiz_id', 'correct', 'wrong'];

    public function student()
    {
    	return $this->belongsTo(Student::class);
    }

    public function quiz()
    {
    	return $this->belongsTo(Quiz::class);
    }
}
