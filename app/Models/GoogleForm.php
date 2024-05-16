<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GoogleForm extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'text',
        'link',
        'active',
    ];
    protected static $logAttributes = [
        'title',
        'text',
        'link',
        'active',
    ];
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
