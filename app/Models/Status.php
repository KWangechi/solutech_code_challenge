<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Status extends Model
{
    use HasFactory, HasApiTokens, SoftDeletes;

    protected $fillable = ['name'];

    public function tasks() {
        return $this->belongsToMany(Task::class);
    }

}
