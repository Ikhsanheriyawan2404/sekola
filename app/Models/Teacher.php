<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'nip', 'gender', 'image', 'phone', 'email'];

    public function studies()
    {
        return $this->belongsToMany(Study::class);
    }
}
