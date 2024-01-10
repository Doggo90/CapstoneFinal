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
        $totalLikesPerWeek = 5;
        if(auth()->guest()){
            return $this->redirect(route('login'));
        }
        $user = auth()->user();

        if($user->hasUpvoted($this->post)){
            $user->likes()->detach($this->post);
            $user->decrement('reputation', 1);
            $user->decrement('likes_counter', 1);
            return;
        }
        if($user->likes_counter < $totalLikesPerWeek){
            $user->likes()->attach($this->post);
            $user->increment('reputation', 1);
            $user->increment('likes_counter', 1);
        }else{
            return redirect(route('home'))->with('message', 'Total amount of likes this week have been reached.');

        }


   }

    public function render()
    {
        // dd();
        return view('livewire.upvote');
    }



}
