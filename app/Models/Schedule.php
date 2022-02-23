<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['day', 'teacher_id', 'study_id', 'classroom_id', 'room_id', 'start', 'finished'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function study()
    {
        return $this->belongsTo(Study::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
