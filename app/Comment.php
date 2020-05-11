<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content', 'created_by_id', 'task_id'
    ];

    public function task()
    {
        return $this->belongsTo(__NAMESPACE__ . '\Task');
    }

    public function createdBy()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User', 'created_by_id');
    }
}
