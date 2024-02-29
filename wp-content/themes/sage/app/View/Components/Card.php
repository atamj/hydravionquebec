<?php

namespace app\View\Components;

use Illuminate\View\Component;
use App\Traits\Themeable;

class Card extends Component
{
    use Themeable;

    public $href;
    public $image;
    public $title;

    public function __construct($title = "title", $href = false, $image = false, $theme = 'default')
    {

        $this->image = $image;
        $this->title = $title;
        $this->href = $href;
        $this->theme = $theme;
    }

    public function render()
    {
        return view('components.card');
    }
}
