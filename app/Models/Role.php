<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Activitylog\Traits\LogsActivity; // Importa el trait LogsActivity
use Spatie\Activitylog\LogOptions; // Importa la clase LogOptions

class Role extends SpatieRole
{
    use LogsActivity; // Agrega el trait LogsActivity

    protected $fillable = ['name', 'description', 'guard_name'];

    /**
     * Get the options for the role activity log.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description', 'guard_name']); // Ajusta los campos según tus necesidades
    }
}
