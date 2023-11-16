<div class="card mx-5">
    <a href="/create" type="button" class="btn btn-primary">Create Post</a>
    @auth
                <form wire:submit="createPost" class="row g-3 mb-4" action="">
                        <div class="col-auto">
                            <a href="/profile/{{auth()->user()->id}}"><img class="img-fluid rounded-circle" style="width: 3rem; height: 3rem;" src="{{ (!empty(auth()->user()->photo)) ? url(auth()->user()->photo) : url('/img/no-image.png')}}" alt="profile">
                            </a>
                        </div>
                        <div class="col">
                            <input class="form-control" rows="3" name="title" id="title" wire:model="title" placeholder="Post Title. ">
                                @error('title')
                                    <p class="p text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                                <input class="form-control" rows="3" name="tags" id="tags" wire:model="tags" placeholder="Tags(Comma Separated)">
                                @error('tags')
                                    <p class="p text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                        </div>
                        <div class="col">
                            <textarea class="form-control" rows="3" name="body" id="body" wire:model="body" placeholder="Post Context"></textarea>
                                @error('body')
                                    <p class="p text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Submit Post</button>
                                {{-- <input type="hidden" name="post_id" value="{{ $this->post->id }}">
                                <input type="hidden" name="user_id" value="{{ $this->$post->user_id }}"> --}}
                        <br>
                </form>
                @else
                <p>You need to log in to Post. <a href="/login">Click here.</a></p>

                @endauth {{-- (auth()->user()) END IF ^^^ --}}
</div>
