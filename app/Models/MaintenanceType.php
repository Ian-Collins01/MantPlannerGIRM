<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceType extends Model
{
    /** @use HasFactory<\Database\Factories\MaintenanceTypeFactory> */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'maintenance_type');
    }

}
