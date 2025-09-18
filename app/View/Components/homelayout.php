<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class homelayout extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public function __construct($title = 'Laravel Ecommerce')
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.homelayout');
    }
}
