<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormRequiredTextField extends Component
{
    public $name;
    public $value;
    public $message;
    public $label;

    public function __construct($name, $label, $message, $value = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->message = $message;
    }

    public function render()
    {
        return view('components.form-required-text-field');
    }
}
