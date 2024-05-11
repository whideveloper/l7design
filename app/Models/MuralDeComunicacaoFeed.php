<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MuralDeComunicacaoFeed extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'mural_category_id',
        'title',
        'description',
        'text',
        'active',
        'sorting',
        'publish_date',
        'path_image',
        'btn_title',
    ];
    protected static $logAttributes = [
        'mural_category_id',
        'title',
        'description',
        'text',
        'active',
        'sorting',
        'publish_date',
        'path_image',
        'btn_title',
    ];

    public function category(){
        return $this->belongsTo(MuralDeComunicacaoCategory::class, 'mural_category_id');
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
    public function scopeSorting($query){
        return $query->orderBy('mural_de_comunicacao_feeds.sorting', 'ASC');
    }
    public function scopeActive($query){
        return $query->where('mural_de_comunicacao_feeds.active', 1);
    }
}
