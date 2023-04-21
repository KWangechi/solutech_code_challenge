<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class Task extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'name', 'description', 'due_date', 'status_id'
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    // relationships
    public function status() {
        return $this->hasOne(Status::class. 'status_id');
    }


}
