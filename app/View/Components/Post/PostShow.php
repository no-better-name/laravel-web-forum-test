<?php

namespace App\View\Components\Post;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class PostShow extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Model $model
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post.post-show');
    }
}
