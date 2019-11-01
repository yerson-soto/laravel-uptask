<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;

class Project extends Model
{
    protected $fillable = [];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
