<x-page-base :title='$title'>
    <x-page-common.list-container :title='$title' :models='$comments' item="comment.comment-item" :query-params='$params' :show-post='$in_post' />
</x-page-base>
