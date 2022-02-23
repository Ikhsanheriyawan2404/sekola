<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Study extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'study_code', 'major_id', 'type'];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
}
