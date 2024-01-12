<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\Rule;

class CreatePost extends Component
{
    public $title = '';
    public $body = '';
    public $tags = '';

    public function createPost()
    {

        $this->validate([
            'title' => 'required | min:2',
            'body' => 'required | min:2',
            'tags' => 'required | min:2',
        ]);
        Post::create([
            'title' => $this->title,
            'body' => $this->body,
            'tags' => $this->tags,
            'user_id' => auth()->user()->id,
            // 'comments_count' => 0,
        ]);
        toastr()->success('Post Created Successfully!');
        $this->title = '';
        $this->body = '';
        $this->tags = '';

    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
