<div class="card bg-list-item" id="comment-{{ $model->id }}">
    @if($showPost or !empty($model->parent_id))
        <div class="card-header d-flex flex-column">
            @if($showPost)
            <small>To post <a href="{{ route('post.show', ['id' => $model->post_id]) }}">{{ $model->post->title }} (#{{ $model->post_id }})</a></small>
            @endif
            @if(!empty($model->parent_id))
            <small>Reply to #{{ $model->parent_id }}</small>
            @endif
        </div>
    @endif
    <div class="card-body d-flex">
        <div class="btn-group-vertical me-2" role="group">
            <button type="button" class="btn text-light btn-success">⯅</button>
            <button type="button" class="btn text-light btn-danger">⯆</button>
        </div>
        <div class="d-flex flex-column justify-content-between me-2" role="group">
            <div class="text-center">{{ $model->users_upvoted()->count() }}</div>
            <div class="text-center">{{ $model->users_downvoted()->count() }}</div>
        </div>
        <p class="card-text">{{ $model->body }}</p>
    </div>
    <div class="card-footer row ms-0 me-0">
        <small class="col text-start ps-0">#{{ $model->id }}</small>
        @if(is_null($model->user_id))
            <small class="col text-start">No author</small>
        @else
            <small class="col text-start">Posted by <a href="{{ route('user.show', ['id' => $model->user_id]) }}">{{ $model->user->name }} (#{{ $model->user->id }})</a></small>
        @endif
        <small class="col text-center">Created {{ $model->created_at }}</small>
        <small class="col text-end pe-0">Modified {{ $model->updated_at }}</small>
    </div>
</div>
