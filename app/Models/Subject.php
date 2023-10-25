<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'description',
        'path_image',
        'active',
        'user_id'
    ];

    function scopeSorting($query){
        return $query->orderBy('sorting', 'ASC');
    }
    function scopeActive($query){
        return $query->where('active', 1);
    }
}
