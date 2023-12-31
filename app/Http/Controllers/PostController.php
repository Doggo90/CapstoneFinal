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
        $categories = Category::all();
        $allposts = Post::all();
        $mostUpvotes = Post::withCount('likes')
        ->orderByDesc('likes_count')
        ->first();
        $mostComments = Post::all()
        ->sortByDesc('comments_count')
        ->first();

        return view('pages.dashboard', compact('allposts','mostUpvotes','mostComments','announcements','categories'));
    }
    public function AnnouncementShow(Announcement $announcement){
        $announcements = Announcement::all();
        $categories1 = Category::all();
        $users = User::all();
        $announcement = Announcement::with('author')->find($announcement->id);


        return view('pages.announcement', compact('users', 'announcement', 'announcements', 'categories1'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function CategoryShow(Category $category)
    {
        $announcements = Announcement::all();
        $categories = Category::with('posts')->find($category->id);
        $categories1 = Category::all();
        $mostUpvotes = Post::withCount('likes')
        ->orderByDesc('likes_count')
        ->first();
        $mostComments = Post::all()
        ->sortByDesc('comments_count')
        ->first();
        return view('pages.category', compact('mostUpvotes','mostComments','announcements','categories','categories1'));
    }
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
        $categories = Post::with('category')->find($post->id);
        $users = User::all();
        $post = Post::with('author')->find($post->id);
        $announcements = Announcement::all();
        $categories1 = Category::all();
        return view('pages.show', compact('users', 'post', 'categories', 'announcements','categories1'));
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
