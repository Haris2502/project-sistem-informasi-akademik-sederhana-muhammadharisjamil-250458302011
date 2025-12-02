<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarItem extends Component
{
    public $route;
    public $icon;
    public $title;
    public $active;

    public function __construct($route = null, $icon = null, $title = null, $active = false)
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->title = $title;
        $this->active = $active;
    }

    public function render()
    {
        return view('components.sidebar-item');
    }
}
