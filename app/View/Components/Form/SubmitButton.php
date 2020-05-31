<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class SubmitButton extends Component
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function render()
    {
        return view('components.form.submit-button');
    }
}
