<div class="card bg-list" data-bs-theme="dark">
    @if(!empty($title) or !empty($subtitle))
        <div class="card-header">
            @if(!empty($title))
                <h2 class="card-title">{{ $title }}</h2>
            @endif
            @if(!empty($subtitle))
                <h3 class="card-subtitle">{{ $subtitle }}</h3>
            @endif
        </div>
    @endif
    <div class="card-body">
        @foreach($models as $model)
            <x-dynamic-component :component='$item' :model='$model' {{ $attributes }} />
        @endforeach
    </div>
    <div class="card-footer">
        {{ $models->withQueryString()->links() }}

        <div>
            <p class="small text-muted">
                Show
                @foreach($itemCounts as $items_count)
                    @php
                        $new_page = floor(1 + ($models->perPage() * ($models->currentPage() - 1))/$items_count);
                        $page_url = $models->withQueryString()->url($new_page);
                    @endphp
                    <a href="{{ url()->query($page_url, [$queryParams['show_count'] => $items_count]) }}">{{ $items_count }}</a>
                    @if(!$loop->last)
                        |
                    @endif
                @endforeach
                items
            </p>
        </div>
    </div>
</div>
