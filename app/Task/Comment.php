<?php

namespace App\Task;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content', 'created_by_id', 'task_id'
    ];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by_id');
    }
}
