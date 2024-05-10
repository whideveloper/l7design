<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class EspecialidadeProfessional extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'name',
        'especialidade_category_id',
        'crm',
        'description',
        'text',
        'active',
        'sorting',
        'path_image'
    ];
    protected static $logAttributes = [
        'name',
        'especialidade_category_id',
        'crm',
        'description',
        'text',
        'active',
        'sorting',
        'path_image'
    ];

    public function category(){
        return $this->belongsTo(EspecialidadeCategory::class, 'especialidade_category_id');
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
        return $query->orderBy('especialidade_professionals.sorting', 'ASC');
    }
    public function scopeActive($query){
        return $query->where('especialidade_professionals.active', 1);
    }
}
