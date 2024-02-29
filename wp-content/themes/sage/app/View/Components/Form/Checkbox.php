<?php

namespace App\View\Components\Form;

class Checkbox extends Control
{
    public $checked;

    public function __construct($name, $id = null, $value = 'on', $bag = 'default', $disabled = false, $theme = 'default', $checked = false)
    {
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->value = $value;
        $this->disabled = $disabled;
        $this->theme = $theme;
        $this->checked = $checked;
    }

    public function render()
    {
	    return $this->view('components.form.checkbox');
    }
}
