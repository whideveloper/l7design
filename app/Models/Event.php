<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'text',
        'active',
        'sorting',
        'date_start'
    ];
    protected static $logAttributes = [
        'title',
        'description',
        'slug',
        'text',
        'active',
        'sorting',
        'date_start'
    ];
    public function scopeSorting($query){
        return $query->orderBy('sorting', 'ASC');
    }
    public function scopeActive($query){
        return $query->where('active', 1);
    }

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
}
