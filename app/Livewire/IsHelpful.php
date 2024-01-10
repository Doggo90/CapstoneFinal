<?php

namespace App\Livewire;

use Livewire\Component;

class IsHelpful extends Component
{
    public $comment;
    public function toggleHelpful(){
        $this->comment->is_helpful = !$this->comment->is_helpful;
        $this->comment->save();
   }
    public function render()
    {
        return view('livewire.is-helpful');
    }
}
