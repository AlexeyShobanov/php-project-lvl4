<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormTextAriaField extends Component
{
    public $name;
    public $label;
    public $value;

    public function __construct($name, $label, $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.form-text-aria-field');
    }
}
