<?php
// app/Models/ActivityLog.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\User;

class ActivityLog extends Model
{
    use LogsActivity;

    protected $table = 'activity_log';

    protected $fillable = [
        'log_name', 'description', 'subject_type', 'subject_id', 'causer_type', 'causer_id',
        'properties', 'created_at', 'updated_at',
    ];

    protected $casts = [
        'properties' => 'collection',
    ];

    public function getExtraPropertiesAttribute()
    {
        return $this->properties->except(['subject', 'causer']);
    }

    /**
     * Define la relación con el modelo User.
     */
    public function causer()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }

    // Implementa el método abstracto requerido por el trait LogsActivity
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['log_name', 'description', 'subject_type', 'subject_id', 'causer_type', 'causer_id', 'properties'])
            ->logName('custom'); // Puedes ajustar según tus necesidades
    }
}
