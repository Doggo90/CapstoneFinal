<button wire:click="toggleUpvote()" type="button" class="btn {{(auth()->user()->hasUpvoted($this->post)) ? ' btn-success' : 'btn btn-light'}}" data-bs-toggle="button" aria-pressed="false">
    <i class="fa fa-arrow-up {{(auth()->user()->hasUpvoted($this->post)) ? 'text-white' : 'text-success'}}me-2"></i>
    <span class="font-weight-bold">{{$this->post->likes()->count()}}</span>
</button>
