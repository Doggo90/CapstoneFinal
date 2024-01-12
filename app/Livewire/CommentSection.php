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
            'comment_body' => 'required | min:2',
        ]);
        $comments2 = Comment::where('post_id', $this->post->id)->get();
        if ($comments2->where('user_id', auth()->user()->id)->count() > 0) {
            toastr()->error('You already commented on this post.');
        } else {
            $comment = Comment::create([
                'user_id' => auth()->user()->id,
                'post_id' => $this->post->id,
                'comment_body' => $this->comment_body,
            ]);
            $this->dispatch('comment-created', $comment);
            if (auth()->user()->email != $this->post->author->email) {
                $this->post->author->notify(new CommentNotif($comment));
            }
            $this->comment_body = '';
            toastr()->success('Comment posted successfully!');
        }
    }
    #[On('comment-created')]
    public function render()
    {
        $comments = Comment::all();
        $flag = false;
        // foreach ($comments as $comment) {
        //     if ($comment->is_helpful == 1) {
        //         $flag = true;
        //     } else {
        //         $flag = false;
        //     }
        // }
        return view('livewire.comment-section', compact('comments', 'flag'));
    }
}
