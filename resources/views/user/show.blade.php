<x-page-base :title='$title'>
    <h2 class="text-light">{{ $title }}</h2>
    @if($sections->count() != 0)
    <x-page-common.list-container title="Sections" :models='$sections' item="section.section-item" :query-params='$section_params' />
    @endif
    @if($posts->count() != 0)
    <x-page-common.list-container title="Posts" :models='$posts' item="post.post-item" :show-section="$show_post_section" :query-params='$post_params' />
    @endif
    @if($comments->count() != 0)
    <x-page-common.list-container title="Comments" :models='$comments' item="comment.comment-item" :show-post="$show_comment_post" :query-params='$comment_params' />
    @endif
    @if($post_votes->count() != 0)
    <x-page-common.list-container title="Post votes" :models='$post_votes' item="post.vote.post-vote-item" :show-post="$show_post_voted" :query-params='$post_vote_params' />
    @endif
</x-page-base>
