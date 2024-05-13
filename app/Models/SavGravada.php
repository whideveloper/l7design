<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavGravada extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'title',
        'link',
        'active',
        'path_image',
        'sorting'
    ];

    protected static $logAttributes = [
        'title',
        'link',
        'active',
        'path_image',
        'sorting'
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    public function scopeSorting($query)
    {
        return $query->orderBy('sorting', 'ASC');
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
