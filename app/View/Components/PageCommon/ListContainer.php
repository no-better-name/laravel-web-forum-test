<?php

namespace App\View\Components\PageCommon;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class ListContainer extends Component
{
    public array $itemCounts;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string|null $title = null,
        public string|null $subtitle = null,
        public LengthAwarePaginator $models,
        array|null $itemCounts = null,
        public string $item,
        public array $queryParams,
    )
    {
        if (is_null($itemCounts)) {
            $this->itemCounts = config('app.pagination_item_counts');
        } else {
            $this->itemCounts = $itemCounts;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page-common.list-container');
    }
}
