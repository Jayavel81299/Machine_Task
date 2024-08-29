<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'project_manager_id',
        'user_ids',
        'description',
        'start_date',
        'end_date',
        'status'
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'deleted_at', 
    ];

    public $timestamps = true;
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
