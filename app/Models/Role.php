<?php

namespace App\Models;

use App\Scopes\SuperAdminScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected static function booted(): void
    {
        static::addGlobalScope(new SuperAdminScope);
    }

    public function scopeSorting($query)
    {
        return $query->orderBy('sorting', 'ASC');
    }

    protected static $logAttributes = [
        'name',
        'guard_name',
        'sorting'
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
