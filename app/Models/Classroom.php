<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'teacher_id', 'major_id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }


}
