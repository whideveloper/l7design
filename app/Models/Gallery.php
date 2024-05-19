<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'title',
        'description',
        'text',
        'active',
        'slug',
        'sorting',
        'path_image',
    ];
    protected static $logAttributes = [
        'title',
        'description',
        'text',
        'active',
        'slug',
        'sorting',
        'path_image',
    ];
    public function galleryImage()
    {
        return $this->hasMany(GalleryImage::class, 'gallery_id');
    }
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