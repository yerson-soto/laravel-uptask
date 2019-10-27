<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'complete' => 'boolean'
    ];
}
