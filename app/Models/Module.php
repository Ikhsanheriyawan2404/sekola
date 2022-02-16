<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'topic', 'description', 'file', 'reference', 'study_id', 'classroom_id', 'teacher_id'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function study()
    {
        return $this->belongsTo(Study::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
