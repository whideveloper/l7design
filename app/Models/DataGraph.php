<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataGraph extends Model
{
    use HasFactory;

    protected $fillable = [
        'cnes',
        'health_unit',
        'county',
        'health_region',
        'cardiology',
        'endocrinology_and_metabology',
        'nursing',
        'family_and_community_medicine',
        'physiatry',
        'neurology',
        'neuropediatrics',
        'nutritionist',
        'psychiatry',
        'child_and_adolescent_psychiatry',
        'urology',
    ];
    protected static $logAttributes = [
        'cnes',
        'health_unit',
        'county',
        'health_region',
        'cardiology',
        'endocrinology_and_metabology',
        'nursing',
        'family_and_community_medicine',
        'physiatry',
        'neurology',
        'neuropediatrics',
        'nutritionist',
        'psychiatry',
        'child_and_adolescent_psychiatry',
        'urology',
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
