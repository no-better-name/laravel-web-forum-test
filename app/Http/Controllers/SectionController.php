<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sections = $this->handlePagination(
            $request,
            Section::query(),
            allowed_sort_fields: ['created_at', 'title'],
        );

        return view('section.list', ['sections' => $sections, 'title' => 'All sections', 'subtitle' => null, 'params' => config('app.key_to_query')]);
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
        $section = Section::findOrFail($id);
        $posts = $this->handlePagination(
            $request,
            $section->posts()->getQuery(),
            allowed_sort_fields: ['created_at', 'title'],
        );

        return view('post.list', ['posts' => $posts, 'title' => $section->title, 'in_section' => false, 'params' => config('app.key_to_query')]);
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
