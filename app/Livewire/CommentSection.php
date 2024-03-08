<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Attributes\On;
use App\Notifications\CommentNotif;
use Livewire\Attributes\Url;
use Xetaio\Mentions\Parser\MentionParser;

class CommentSection extends Component
{
    public Post $post;

    public $comment_body = '';
    public $search = '';
    public $results = [];

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

            //
            // dd($content);
            $parser = new MentionParser($comment);
            $content = $parser->parse($comment->comment_body);
            $comment->content = $content;
            $comment->save();
            $this->dispatch('comment-created', $comment);
            if (auth()->user()->email != $this->post->author->email) {
                $this->post->author->notify(new CommentNotif($comment));
            }
            $this->comment_body = '';
            toastr()->success('Comment posted!');
        }
    }
    public function mentionUser($email,Comment $comment){

        $mentionedUser = User::where('email', $email)->first();
        if ($mentionedUser) {
            // Extract the last word with '/' character from the comment body
            preg_match('/\/\w+\b/', $this->comment_body, $matches);
            $lastWordWithSlash = end($matches);

            // Replace the last word with the new mentioned user's name
            $this->comment_body = preg_replace('/' . preg_quote($lastWordWithSlash, '/') . '/', '@' . $mentionedUser->name, $this->comment_body, 1);
        }

        $comment->update();

        // $msg = $comment_body;
        // preg_match_all('/(/\w+)/', $msg, $matches);
        // foreach ($matches[0] as $username){
        //     $this->comment_body .= '@' . $username->name;
        // }

    }

    #[On('comment-created')]
    public function render()
    {
        // $users = User::where('name', 'like', '%' . $this->search . '%')->get();
        $comments = Comment::all();
        $flag = false;
        $results = User::where('name', 'like', '%' . substr($this->search, 1) . '%')
        ->orWhere('email', 'like', '%' . substr($this->search, 1) . '%')
        ->get();

        // dd($results);

        return view('livewire.comment-section', compact('results','comments', 'flag'));
    }
}
