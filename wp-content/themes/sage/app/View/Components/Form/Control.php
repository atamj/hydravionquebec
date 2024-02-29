<?php

namespace App\View\Components\Form;

use Illuminate\View\AppendableAttributeValue;
use Illuminate\View\Component;
use App\Traits\Themeable;

abstract class Control extends Component
{
    use Themeable;

    public $name;
    public $id;
    public $value;
    public $disabled;

    public function __construct($name, $id = null, $value = '', $bag = 'default', $disabled = false, $theme = 'default')
    {
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->disabled = $disabled;
        $this->theme = $theme;
    }

    public function controlAttributes()
    {
        return $this->attributes->merge([
            'name' => $this->name,
            'id' => $this->id,
            'disabled' => $this->disabled,
            'class' => $this->theme($this->disabled ? 'disabled' : 'normal'),
        ]);
    }
}

