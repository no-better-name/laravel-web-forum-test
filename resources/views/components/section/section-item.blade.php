<div class="card bg-list-item" id="section-{{ $model->id }}">
    <div class="card-header">
        <a href="{{ route('section.post.list', ['id' => $model->id]) }}"><h3>{{ $model->title }}</h3></a>
    </div>
    <div class="card-body">
        <p class="card-text">{{ $model->description }}</p>
    </div>
    <div class="card-footer row ms-0 me-0">
        <small class="col text-start ps-0">#{{ $model->id }}</small>
        @if(is_null($model->user_id))
            <small class="col text-start">No owner</small>
        @else
            <small class="col text-start">Owned by <a href="{{ route('user.show', ['id' => $model->user_id]) }}">{{ $model->user->name }} (#{{ $model->user->id }})</a></small>
        @endif
        <small class="col text-end pe-0">Created {{ $model->created_at }}</small>
    </div>
</div>
