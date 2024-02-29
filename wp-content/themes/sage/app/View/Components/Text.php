<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Traits\Themeable;

class Text extends Component
{
    use Themeable;

    public function __construct($href = null, $theme = 'default')
    {
        $this->theme = $theme;
    }

    public function render()
    {
        return view('components.text');
    }
}
