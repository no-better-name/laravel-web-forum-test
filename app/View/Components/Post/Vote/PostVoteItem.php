<?php

namespace App\View\Components\Post\Vote;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class PostVoteItem extends Component
{
    public $vote_adjectives = ['up' => 'positive', 'down' => 'negative'];
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Model $model,
        public bool $showPost = false,
    )
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post.vote.post-vote-item');
    }
}
