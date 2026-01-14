<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{ public string $title;
    public ?string $subtitle;

    public function __construct(string $title, string $subtitle = null)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page-header');
    }
}
