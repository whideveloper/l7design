<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'video_id',
        'video_title',
        'name',
        'email',
        'localidade',
        'locality',
        'data_hora',
    ];

    protected static $logAttributes = [
        'video_id',
        'video_title',
        'name',
        'email',
        'localidade',
        'locality',
        'data_hora',
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
}
