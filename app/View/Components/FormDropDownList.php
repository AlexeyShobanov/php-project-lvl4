<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormDropDownList extends Component
{
    public $name;
    public $label;
    public $dataList;
    public $placeholder;
    public $value;
    //public $selected;


    public function __construct($name, $label, $dataList, $placeholder, $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->dataList = $dataList;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    /* public function isSelected($option)
    {
        return $option === $this->selected;
    }*/

    public function render()
    {
        return view('components.form-drop-down-list');
    }
}
