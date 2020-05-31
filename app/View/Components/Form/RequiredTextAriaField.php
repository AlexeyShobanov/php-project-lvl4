<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class RequiredTextAriaField extends Component
{
    public $name;
    public $message;
    public $label;
    public $value;

    public function __construct($name, $label, $message, $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->message = $message;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.form.required-text-aria-field');
    }
}
