<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'name', 'description', 'color_id'
    ];

    public function tasks()
    {
        return $this->hasMany(__NAMESPACE__ . '\Task');
    }

    public function color()
    {
        return $this->belongsTo(__NAMESPACE__ . '\Color');
    }
}
