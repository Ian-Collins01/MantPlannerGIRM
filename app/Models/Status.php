<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /** @use HasFactory<\Database\Factories\StatusFactory> */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['description'];
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    public static function badgeColor($statusId)
    {
        switch ($statusId) {
            case 1:
                $badgeColor = 'text-bg-info';
                break;
            case 2:
                $badgeColor = 'text-bg-warning';
                break;
            case 3:
                $badgeColor = 'text-bg-danger';
                break;
            case 4:
                $badgeColor = 'text-bg-success';
                break;
            default:
                $badgeColor = 'text-bg-dark';
                break;
        }
        return $badgeColor;
    }
}
