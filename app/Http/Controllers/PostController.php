<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostVote;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = $this->handlePagination(
            $request,
            Post::query(),
            allowed_sort_fields: ['created_at', 'title'],
        );

        return view('post.list', ['posts' => $posts, 'title' => 'All posts', 'in_section' => true, 'params' => config('app.key_to_query')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $post = Post::with(['votes'])->findOrFail($id);
        $comment_params = ['sort_by' => 'comment_sort', 'order' => 'comment_order', 'show_count' => 'comment_count'];
        $comments = $this->handlePagination(
            $request,
            $post->comments()->getQuery(),
            query_params: $comment_params,
            page_name: 'comment_page',
        );

        $vote_params = ['sort_by' => 'vote_sort', 'order' => 'vote_order', 'show_count' => 'vote_count'];
        $votes = $this->handlePagination(
            $request,
            $post->votes()->getQuery(),
            query_params: $vote_params,
            page_name: 'vote_page',
            id: ['user_id', 'post_id'],
        );

        return view('post.show', ['post' => $post, 'comments' => $comments, 'votes' => $votes, 'comment_params' => $comment_params, 'vote_params' => $vote_params, 'in_post' => false, 'item_count' => config('app.pagination_item_counts')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
