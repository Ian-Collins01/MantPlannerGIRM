<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [
        'date',
        'notice_hour',
        'start_hour',
        'end_hour',
        'response_time',
        'maintenance_time',
        'description',
        'has_stoppage',
        'machine_id',
        'technician_id',
        'maintenance_type',
        'status_id',
    ];
    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
    public function maintenanceType()
    {
        return $this->belongsTo(MaintenanceType::class, 'maintenance_type');
    }
    public function maintenanceTasks()
    {
        return $this->hasMany(MaintenanceTask::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
