<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'study_code', 'major_id', 'type'];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
