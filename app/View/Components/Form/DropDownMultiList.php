<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class DropDownMultiList extends Component
{
    public $name;
    public $label;
    public $dataList;
    public $placeholder;
    public $value;

    public function __construct($name, $label, $dataList, $placeholder, $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->dataList = $dataList;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.form.drop-down-multi-list');
    }
}
