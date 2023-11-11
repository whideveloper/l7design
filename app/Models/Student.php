<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Student extends Model
{
    use HasFactory, softDeletes, LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'sorting',
    ];

    protected static $logAttributes = [
        'name',
        'email',
        'password',
        'active',
        'sorting',
    ];

    protected static $logOnlyDirty = true;

    public function customProperties()
    {
        $properties = [];

        foreach (static::$logAttributes as $attribute) {
            $properties['old'][$attribute] = $this->getOriginal($attribute);
            $properties['new'][$attribute] = $this->getAttribute($attribute);
        }

        return $properties;
    }

    public function subject() {
        return $this->belongsToMany(Subject::class, 'student_subjects');
    }

    function scopeSorting($query){
        return $query->orderBy('sorting', 'ASC');
    }

    function scopeActive($query){
        return $query->where('active', 1);
    }
}
