<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Post;
use App\Models\User;
use App\Notifications\ReplyNotif;

class ReplySection extends Component
{
    public Post $post;

    public Comment $comment;

    public $body = '';
    public function createReply()
    {
        $this->validate([
            'body' => 'required | min:2',
        ]);
        // ONLY ONE COMMENT PER USER PER POST LOGIC
        $comments2 = Comment::where('post_id', $this->comment->id)->get();
        $reply = Reply::create([
            'user_id' => auth()->user()->id,
            'comment_id' => $this->comment->id,
            'body' => $this->body,
        ]);

        $this->dispatch('reply-created', $reply);
        // $this->dispatch('comment-created', $comment);

        // NOTIFICATION FOR REPLIES RECEIVED BY USER
        if (auth()->user()->email != $this->comment->author->email) {
            $this->comment->author->notify(new ReplyNotif($reply));
        }
        $this->body = '';
        toastr()->success('Reply posted!');

    }

    public function render()
    {
        // $users = User::where('name', 'like', '%' . $this->search . '%')->get();
        $replyCount = Reply::where('comment_id', $this->comment->id)->count();
        $replies = Reply::all();
        return view('livewire.reply-section', compact('replies', 'replyCount'));
    }
}
