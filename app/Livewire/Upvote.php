<?php

namespace App\Livewire;


use App\Models\User;
use App\Models\Post;
use Livewire\Component;
class Upvote extends Component
{
    public Post $post;
    protected $debug = true;



   public function toggleUpvote(){

        if(auth()->guest()){
            return $this->redirect(route('login'));
        }
        $user = auth()->user();

        if($user->hasUpvoted($this->post)){
            $user->likes()->detach($this->post);
            $user->decrement('reputation', 1);
            return;
        }
        $user->likes()->attach($this->post);
        $user->increment('reputation', 1);
   }

    public function render()
    {
        // dd();
        return view('livewire.upvote');
    }



}
