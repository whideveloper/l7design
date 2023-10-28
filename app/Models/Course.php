<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'text',
        'slug',
        'path_image',
        'link_youtube',
        'link_vimeo',
        'video',
        'active',
        'subject_id',
        'sorting',
    ];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeSorting($query){
        return $query->orderBy('sorting', 'ASC');
    }
}
