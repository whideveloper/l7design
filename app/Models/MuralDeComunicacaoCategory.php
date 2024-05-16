<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MuralDeComunicacaoCategory extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = ['title', 'slug', 'sorting', 'active'];
    protected static $logAttributes = ['title', 'slug', 'sorting', 'active'];

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
        return $query->orderBy('mural_de_comunicacao_categories.sorting', 'ASC');
    }
    public function scopeActive($query){
        return $query->where('mural_de_comunicacao_categories.active', 1);
    }
}
