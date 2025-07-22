<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    /** @use HasFactory<\Database\Factories\AreaFactory> */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];
    public function machines()
    {
        return $this->hasMany(Machine::class);
    }

}
