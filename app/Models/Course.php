<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Course extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;
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

    protected static $logAttributes = [
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

    public function file(){
        return $this->hasMany(File::class, 'course_id');
    }
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
