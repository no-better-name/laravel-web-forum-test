<x-page-base :title='$post->title'>
    <x-post.post-show :model='$post'/>
    <x-page-common.list-container title="Votes" :models='$votes' item='post.vote.post-vote-item' :show-post="$in_post" :item-counts="$item_count" :query-params='$vote_params' />
    <x-page-common.list-container title="Comments" :models='$comments' item='comment.comment-item' :query-params='$comment_params' />
</x-page-base>
