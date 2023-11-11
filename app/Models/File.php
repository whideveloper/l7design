<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class File extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'course_id',
        'title',
        'path_file',
        'description',
        'end_date',
        'sorting',
    ];

    protected static $logAttributes = [
        'course_id',
        'title',
        'path_file',
        'description',
        'end_date',
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
