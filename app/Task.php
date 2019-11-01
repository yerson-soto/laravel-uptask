<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class Task extends Model
{

    protected $hidden = [
        'project_id'
    ];

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'is_completed' => 'boolean'
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
