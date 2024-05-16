<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryImage extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'gallery_id',
        'path_image',
        'sorting'
    ];
    protected static $logAttributes = [
        'gallery_id',
        'path_image',
        'sorting'
    ];
    public function scopeSorting($query){
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
