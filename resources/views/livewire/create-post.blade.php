<div class="card mx-5">
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Create Post
  </button>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <br><br>
          <h1 class="modal-title fs-5 ms-auto" id="staticBackdropLabel">Think Before You Click.</h1>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <br>
            <form wire:submit.prevent="createPost" class="row g-3 mb-4" action="" wire:ignore>
                <div class="row mb-2 ms-auto">
                        <input class="form-control mb-3" rows="3" name="title" id="title" wire:model="title" placeholder="Post Title. ">
                            @error('title')
                                <p class="p text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror

                            <input class="form-control mb-3" rows="3" name="tags" id="tags" wire:model="tags" placeholder="Tags(Comma Separated)">
                            @error('tags')
                                <p class="p text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                </div>
                <div class="row mb-2 ms-auto">
                    <textarea class="form-control mb-3" rows="3" name="body" id="body" wire:model="body" placeholder="Post Context"></textarea>
                        @error('body')
                            <p class="p text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                </div>
                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Submit Post</button>
            </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
</div>
{{-- <div class="card mx-5">
    <a href="/create" type="button" class="btn btn-primary">Create Post</a>
    @auth
                <form wire:submit="createPost" class="row g-3 mb-4" action="">
                        <div class="col-auto">
                            <a href="/profile/{{auth()->user()->id}}"><img class="img-fluid rounded-circle" style="width: 3rem; height: 3rem;" src="{{ (!empty(auth()->user()->photo)) ? url(auth()->user()->photo) : url('/img/no-image.png')}}" alt="profile">
                            </a>
                        </div>
                        <div class="col">
                            <input class="form-control" rows="3" name="title" id="title" wire:model.live="title" placeholder="Post Title. ">
                                @error('title')
                                    <p class="p text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                                <input class="form-control" rows="3" name="tags" id="tags" wire:model.live="tags" placeholder="Tags(Comma Separated)">
                                @error('tags')
                                    <p class="p text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                        </div>
                        <div class="col">
                            <textarea class="form-control" rows="3" name="body" id="body" wire:model.live="body" placeholder="Post Context"></textarea>
                                @error('body')
                                    <p class="p text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Submit Post</button>
                        <br>
                </form>
                @else
                <p>You need to log in to Post. <a href="/login">Click here.</a></p>

    @endauth
</div> --}}
