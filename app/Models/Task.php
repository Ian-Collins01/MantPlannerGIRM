<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    protected $fillable = ['name', 'description', 'task_header_id'];
    public function header()
    {
        return $this->belongsTo(TaskHeader::class, 'task_header_id');
    }
}
