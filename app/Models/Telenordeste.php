<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telenordeste extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'active',
        'sorting',
    ];

    public function scopeSorting($query){
        return $query->orderBy('sorting', 'ASC');
    }
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
