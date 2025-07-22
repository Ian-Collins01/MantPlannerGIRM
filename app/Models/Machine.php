<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    /** @use HasFactory<\Database\Factories\MachineFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'area_id',
    ];
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

}
