<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'name', 'btn_style'
    ];

    public function labels()
    {
        return $this->hasMany(__NAMESPACE__ . '\Label');
    }
}
