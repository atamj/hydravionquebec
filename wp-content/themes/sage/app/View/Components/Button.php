<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Traits\Themeable;

class Button extends Component
{
    use Themeable;

    public $href;

    public function __construct($href = null, $theme = 'default')
    {
        $this->href = $href;
        $this->theme = $theme;
    }

    public function render()
    {
        return view('components.button');
    }
}
