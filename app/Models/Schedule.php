<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['day', 'study_id', 'classroom_id', 'room_id', 'start', 'finished'];

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
