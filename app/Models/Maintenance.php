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
        'lead_time',
        'response_time',
        'maintenance_time',
        'description',
        'has_stoppage_machine',
        'machine_id',
        'technician_id',
        'applicant_id',
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
    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id');
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
    public function stoppages()
    {
        return $this->hasMany(Stoppage::class);
    }
}
