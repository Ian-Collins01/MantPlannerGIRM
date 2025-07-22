<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceTask extends Model
{
    protected $fillable = [
        'maintenance_id',
        'task_header_id',
        'task_description',
        'completed',
        'notes',
    ];
    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }

    public function header()
    {
        return $this->belongsTo(TaskHeader::class, 'task_header_id');
    }
}
