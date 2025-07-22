<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskHeader extends Model
{
    /** @use HasFactory<\Database\Factories\TaskHeaderFactory> */
    use HasFactory;
    protected $fillable = ['name'];
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function maintenanceTasks()
    {
        return $this->hasMany(MaintenanceTask::class);
    }

}
