<div class="card bg-list-item">
    <div class="small card-body row ms-0 me-0">
        <div class="col ps-0">
            <a href="{{ route('user.show', ['id' => $model->user_id]) }}">{{ $model->user->name }} (#{{ $model->user_id }})</a>
        </div>
        <div class="col text-center">
            <strong>{{ $model->vote }}vote</strong>
        </div>
        @if($showPost)
        <div class="col">
            <a href="{{ route('post.show', ['id' => $model->post_id]) }}">{{ $model->post->title }} (#{{ $model->post_id }})</a>
        </div>
        @endif
        <div class="col text-center">
            First vote: {{ $model->created_at }}
        </div>
        <div class="col text-end pe-0">
            Last changed: {{ $model->updated_at }}
        </div>
    </div>
</div>
