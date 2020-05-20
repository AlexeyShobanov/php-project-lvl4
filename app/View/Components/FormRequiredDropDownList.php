<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormRequiredDropDownList extends Component
{
    public $name;
    public $label;
    public $dataList;
    public $placeholder;
    public $value;
    public $message;


    public function __construct($name, $label, $dataList, $placeholder, $message, $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->dataList = $dataList;
        $this->value = $value;
        $this->message = $message;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.form-required-drop-down-list');
    }
}
