<div class="card bg-list-item" data-bs-theme="dark">
    <div class="card-header">
        <h3>{{ $model->title }}</h3>
        <small>In section <a href="{{ route('section.post.list', ['id' => $model->section_id]) }}">{{ $model->section->title }} (#{{ $model->section_id }})</a></small>
    </div>
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
