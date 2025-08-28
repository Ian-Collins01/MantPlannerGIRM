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
                $badgeColor = 'info';
                break;
            case 2:
                $badgeColor = 'warning';
                break;
            case 3:
                $badgeColor = 'danger';
                break;
            case 4:
                $badgeColor = 'secondary';
                break;
            case 5:
                $badgeColor = 'success';
                break;
            default:
                $badgeColor = 'dark';
                break;
        }
        return $badgeColor;
    }
}
