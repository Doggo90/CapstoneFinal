<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use Livewire\Attributes\Rule;
use Livewire\Attributes\On;
use App\Notifications\CommentNotif;

class CommentSection extends Component
{
    public Post $post;

    public $comment_body = '';

    public function createComment()
    {

        $this->validate([
            'comment_body' => 'required | min:2'
        ]);

        $comment = Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->post->id,
            'comment_body' => $this->comment_body
        ]);
        $this->dispatch('comment-created', $comment);
        if(auth()->user()->email != $this->post->author->email){
            $this->post->author->notify(new CommentNotif($comment));
        }
        $this->comment_body = '';

    }
    #[On('comment-created')]
    public function render()
    {
        $comments = Comment::all();
        return view('livewire.comment-section', compact('comments'));
    }
}
