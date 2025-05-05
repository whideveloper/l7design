<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SectionTitlePerformance extends Model
{
    use HasFactory, Notifiable, LogsActivity;

    protected $table = 'section_title_performances'; 

    protected $fillable = [
        'title',
        'description',
    ];

    protected static $logAttributes = [
        'title',
        'description', 
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
