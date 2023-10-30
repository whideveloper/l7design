<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentSubjects extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'student_id',
        'subject_id',
    ];
    public function subject(){
        return $this->hasMany(StudentSubjects::class, 'student_id')->with('subject');
    }
}
