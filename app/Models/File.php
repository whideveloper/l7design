<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'title',
        'path_file',
        'description',
        'end_date',
        'sorting',
    ];
    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function fileResponses(){
        return $this->hasMany(FileResponse::class, 'file_id');
    }
    public function students(){
        return $this->hasMany(Student::class, 'id');
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeSorting($query){
        return $query->orderBy('sorting', 'ASC');
    }
}
