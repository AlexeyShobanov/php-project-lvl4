<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected const MESSAGES = [
            'required' => "The :attribute field is required!",
            'string' => "The :attribute must be string!",
            'max' => "The :attribute exceeds the maximum number of characters equal to :max!",
        ];
}
