<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskStatus extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function tasks()
    {
        return $this->hasMany(__NAMESPACE__ . '\Task', 'status_id');
    }

    public function __toString()
    {
        return $this->name;
    }
}
