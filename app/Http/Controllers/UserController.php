<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $user = User::findOrFail($id);

        $gate_response = Gate::inspect('viewAny', $user);
        if ($gate_response->denied()) {
            $request->session()->flash('user-messages', true);
            $request->session()->flash('view-user-error', $gate_response->message());
            return back();
        }

        $gate_response = Gate::inspect('view', $user);
        if ($gate_response->denied()) {
            $request->session()->flash('user-messages', true);
            $request->session()->flash('view-user-error', $gate_response->message());
            return back();
        }

        $section_params = ['sort_by' => 'section_sort', 'order' => 'section_order', 'show_count' => 'section_count'];
        $post_params = ['sort_by' => 'post_sort', 'order' => 'post_order', 'show_count' => 'post_count'];
        $comment_params = ['sort_by' => 'comment_sort', 'order' => 'comment_order', 'show_count' => 'comment_count'];
        $post_vote_params = ['sort_by' => 'post_sort', 'order' => 'post_order', 'show_count' => 'post_count'];

        $sections = $this->handlePagination(
            $request,
            $user->sections()->getQuery(),
            query_params: $section_params,
            page_name: 'section_page',
        );
        $posts = $this->handlePagination(
            $request,
            $user->posts()->getQuery(),
            query_params: $post_params,
            page_name: 'post_page',
        );
        $comments = $this->handlePagination(
            $request,
            $user->comments()->getQuery(),
            query_params: $comment_params,
            page_name: 'comment_page',
        );
        $post_votes = $this->handlePagination(
            $request,
            $user->post_votes()->getQuery(),
            query_params: $post_vote_params,
            page_name: 'post_vote_page',
            id: ['post_id', 'user_id'],
        );

        return view('user.show', [
            'sections' => $sections,
            'posts' => $posts,
            'comments' => $comments,
            'post_votes' => $post_votes,

            'section_params' => $section_params,
            'post_params' => $post_params,
            'comment_params' => $comment_params,
            'post_vote_params' => $post_vote_params,

            'show_post_section' => true,
            'show_comment_post' => true,
            'show_post_voted' => true,

            'title' => $user->name,
        ]);
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
