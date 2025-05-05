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


}
