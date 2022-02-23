<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'nip', 'gender', 'image', 'phone', 'email'];

    public function studies()
    {
        return $this->belongsToMany(Study::class);
    }
}
