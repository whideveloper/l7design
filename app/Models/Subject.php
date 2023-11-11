<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Subject extends Model
{
    use HasFactory, softDeletes, LogsActivity;

    protected $fillable = [
        'name',
        'description',
        'path_image',
        'active',
        'user_id',
    ];

    protected static $logAttributes = [
        'name',
        'description',
        'path_image',
        'active',
        'user_id',
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

    public function students() {
        return $this->belongsToMany(Student::class, 'student_subjects');
    }
    public function userId()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    function scopeSorting($query){
        return $query->orderBy('subjects.sorting', 'ASC');
    }
    function scopeActive($query){
        return $query->where('subjects.active', 1);
    }
}
