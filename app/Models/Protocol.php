<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Protocol extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'title',
        'text',
        'active',
        'btn_title',
        'slug',
        'path_file',
        'path_image',
    ];

    protected static $logAttributes = [
        'title',
        'text',
        'active',
        'btn_title',
        'slug',
        'path_file',
        'path_image',
    ];

    public function scopeActive($query)
    {
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