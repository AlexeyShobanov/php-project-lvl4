<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
     protected $fillable = [
        'name', 'description', 'color'
    ];

    public function tasks()
    {
        return $this->hasMany(__NAMESPACE__ . '\Task', 'label_id');
    }
}
