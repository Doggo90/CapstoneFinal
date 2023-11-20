<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comments;
use App\Models\User;
use App\Http\Controllers\CommentsController;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $announcements = Announcement::all();
        $allposts = Post::all();
        $mostUpvotes = Post::withCount('likes')
        ->orderByDesc('likes_count')
        ->first();
        $mostComments = Post::all()
        ->sortByDesc('comments_count')
        ->first();

        return view('pages.dashboard', compact('allposts','mostUpvotes','mostComments'));
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
    public function show(Post $post)
    {
        $users = User::all();
        $post = Post::with('author')->find($post->id);

        return view('pages.show', compact('users', 'post'));
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
    public function archives(Request $request)
    {
        $announcements = Announcement::all();
        $allposts = Post::all();
        return view('pages.archives', compact('announcements', 'allposts'));
    }

}
