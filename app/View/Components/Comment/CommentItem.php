<?php

namespace App\View\Components\Comment;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class CommentItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Model $model,
        public bool $showPost = false,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.comment.comment-item');
    }
}
