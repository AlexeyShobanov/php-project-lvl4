<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', 'description', 'status_id', 'created_by_id', 'assigned_to_id'
    ];

    public function status()
    {
        return $this->belongsTo(__NAMESPACE__ . '\TaskStatus');
    }

    public function created_by()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User');
    }

    public function assigned_to()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User');
    }

}
