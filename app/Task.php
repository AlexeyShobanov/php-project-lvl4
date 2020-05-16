<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', 'description', 'status_id', 'created_by_id', 'assigned_to_id', 'label_id'
    ];

    public function status()
    {
        return $this->belongsTo(__NAMESPACE__ . '\TaskStatus');
    }

    public function createdBy()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User', 'created_by_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User', 'assigned_to_id');
    }

    public function label()
    {
        return $this->belongsTo(__NAMESPACE__ . '\Label');
    }

    public function comments()
    {
        return $this->hasMany(__NAMESPACE__ . '\Task\Comment');
    }
}
