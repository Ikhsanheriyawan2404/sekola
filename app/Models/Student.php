<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'nisn', 'gender', 'religion', 'date_of_birth', 'phone', 'image', 'address', 'classroom_id'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function getTakeImageAttribute()
    {
        return "/storage/" . $this->image;
    }
}
