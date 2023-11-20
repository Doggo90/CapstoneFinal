<section class="mb-5">
    <div class="card bg-light">
        <div class="card-body">
            <!-- Comment form-->
            @auth
                <form wire:submit="createComment" class="row g-3 mb-4" action="">
                        <div class="col-auto">
                            <a href="/profile/{{auth()->user()->id}}"><img class="img-fluid rounded-circle" style="width: 3rem; height: 3rem;" src="{{ (!empty(auth()->user()->photo)) ? url(auth()->user()->photo) : url('/img/no-image.png')}}" alt="profile">
                            </a>
                        </div>
                        <div class="col">
                            <textarea class="form-control" rows="3" name="comment_body" id="comment_body" wire:model="comment_body" placeholder="Join the discussion and leave a comment!"></textarea>
                                @error('comment_body')
                                    <p class="p text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Comment</button>
                                {{-- <input type="hidden" name="post_id" value="{{ $this->post->id }}">
                                <input type="hidden" name="user_id" value="{{ $this->$post->user_id }}"> --}}
                        <br>
                </form>
                @else
                <p>You need to log in to comment. <a href="/login">Click here.</a></p>

                @endauth {{-- (auth()->user()) END IF ^^^ --}}
            <!-- Comment with nested comments-->


            @foreach($comments as $comment)
                @if($comment->post_id === $this->post->id)
                    <div class="d-flex mb-4">
                        <!-- Parent comment-->
                        <a href="/profile/{{$comment->author->id}}">
                            <div class="flex-shrink-0"><img class="img-fluid rounded-circle" style="width: 3rem; height: 3rem;" src="{{ (!empty($comment->author->photo)) ? url($comment->author->photo) : url('/img/no-image.png')}}" alt="..."></div>
                        </a>
                        <div class="ms-3">
                            <a href="/profile/{{$comment->author->id}}">
                                <div class="fw-bold">{{$comment->author->name}}</div>
                            </a>
                            {{$comment->comment_body}}
                            <!-- Child comment 1-->
                            <div>
                                <small>
                                    {{ $comment->created_at->diffForHumans() }}
                                </small>
                            </div>

                        </div>
                    </div>
                @endif
            @endforeach
            <div class="d-flex mt-4">
                        {{-- <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..."></div>
                        <div class="ms-3">
                            <div class="fw-bold">{{$comment->author->name}}</div>
                            {{$comment->comment_body}}
                        </div>
                        {{ $comment->created_at->diffForHumans() }}
                    </div>
                    <!-- Child comment 2-->
                    <div class="d-flex mt-4">
                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..."></div>
                        <div class="ms-3">
                            <div class="fw-bold">Commenter Name</div>
                            When you put money directly to a problem, it makes a good headline.
                        </div>
                    </div> --}}
            <!-- Single comment-->
            {{-- <div class="d-flex">
                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..."></div>
                <div class="ms-3">
                    <div class="fw-bold">Commenter Name</div>
                    When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                </div>
            </div> --}}
        </div>
    </div>
</section>
