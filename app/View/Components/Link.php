<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Link extends Component
{
    public $name;
    public $route;

    public function __construct($name, $route)
    {
        $this->name = $name;
        $this->route = $route;
    }

    public function render()
    {
        return view('components.link');
    }
}
