<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stoppage extends Model
{
    protected $fillable = [
        'start_hour',
        'end_hour',
        'reason',
    ];
    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }
}
