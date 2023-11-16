<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Upvote extends Component
{
    public Post $post;

   public function toggleUpvote(){

        if(auth()->guest()){
            return $this->redirect(route('login'));
        }
        $user = auth()->user();

        if($user->hasUpvoted($this->post)){
            $user->likes()->detach($this->post);
            return;
        }
        $user->likes()->attach($this->post);
   }

    public function render()
    {
        return view('livewire.upvote');
    }
}
