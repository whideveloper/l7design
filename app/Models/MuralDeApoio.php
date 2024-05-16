<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class MuralDeApoio extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'text',
        'active',
    ];
    protected static $logAttributes = [
        'text',
        'active',
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

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
