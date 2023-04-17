<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class UserTask extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'user_id', 'task_id', 'due_date', 'start_time', 'end_time', 'remarks', 'status_id'
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // relationships

    public function tasks() {
        return $this->hasMany(Task::class, 'task_id');
    }

    public function status() {
        return $this->hasMany(Status::class, 'status_id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_id');
    }
}
