<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageBase extends Component
{
    public string $title;
    /**
     * Create a new component instance.
     */
    public function __construct(
        string|null $title,
        public string|null $description
    )
    {
        if (empty($title)) {
            $title = config('app.jingle');
        }
        $title = $title . ' — ' . config('app.name');
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page-base');
    }
}
