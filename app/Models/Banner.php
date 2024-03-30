<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;

    use HasFactory, SoftDeletes;
    protected $fillable = [
        'link',
        'active',
        'start_date',
        'end_date',
        'path_image',
        'path_image_mobile',
        'sorting'
    ];

    public function scopeSorting($query){
        return $query->orderBy('sorting', 'ASC');
    }
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
