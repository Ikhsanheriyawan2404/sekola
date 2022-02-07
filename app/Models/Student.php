<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'nisn', 'gender', 'religion', 'date_of_birth', 'phone', 'photo', 'address'];
}
