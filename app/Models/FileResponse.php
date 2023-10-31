<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileResponse extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'file_id',
        'user_id',
        'course_id',
        'path_file',
        'adjusted',
    ];

    public function scopeAjusted($query){
        return $query('adjusted', 1);
    }
}
