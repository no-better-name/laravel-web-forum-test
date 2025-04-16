<x-page-base :title='$title'>
    <x-page-common.list-container :title='$title' :models='$posts' item="post.post-item" :show-section="$in_section" :query-params='$params' />
</x-page-base>
