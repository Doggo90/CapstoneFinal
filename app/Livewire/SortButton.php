<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;

class SortButton extends Component
{

    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public function setSortBy($sortByField){

        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? "DESC" : "ASC";
            return;
        }
        $this->sortBy = $sortByField;
    }

    public function render()
    {
        $posts = Post::search($this->search)
        ->withCount(['likes', 'comments'])
        ->orderBy($this->sortBy, $this->sortDir)
        ->get();
        $categories = Category::with('posts')->get();
        return view('livewire.sort-button',compact('posts', 'categories'));
    }
}
