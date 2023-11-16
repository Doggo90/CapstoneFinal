<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use Livewire\Attributes\Rule;

class CommentSection extends Component
{
    public Post $post;

    public $comment_body = '';

    public function createComment()
    {

        $this->validate([
            'comment_body' => 'required | min:2'
        ]);
        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->post->id,
            'comment_body' => $this->comment_body
        ]);
        $this->comment_body = '';

    }

    public function render()
    {
        $comments = Comment::all();
        return view('livewire.comment-section', compact('comments'));
    }
}
