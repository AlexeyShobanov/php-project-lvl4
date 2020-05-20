<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Label extends Model
{
    use SoftDeletes;

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

    public function __toString()
    {
        return $this->name;
    }
}
