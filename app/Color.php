<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'btn_style'
    ];

    public function labels()
    {
        return $this->hasMany(__NAMESPACE__ . '\Label');
    }

    public function __toString()
    {
        return $this->name;
    }
}
