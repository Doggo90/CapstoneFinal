<section>
    <div class="bg-light mt-2 ms-4" style="flex-grow: 1;">
            <!-- Comment form-->
            @auth
                <form wire:submit="createReply" class="row g-3 mb-4" action="">
                    <div class="col-auto">
                        <a href="/profile/{{ auth()->user()->id }}"><img class="img-fluid rounded-circle"
                                style="width: 3rem; height: 3rem;"
                                src="{{ !empty(auth()->user()->photo) ? url(auth()->user()->photo) : url('/img/no-image.png') }}"
                                alt="profile">
                        </a>
                    </div>
                    <div class="col position-relative">
                        <form wire:submit="createComment">
                            @csrf
                            <textarea class="form-control" rows="2" name="body" id="body" wire:model.live="body"
                                placeholder="Join the discussion and leave a reply!" wire:keydown.enter="createReply">
                        </textarea>
                            <button type="submit"
                                class="btn btn-success position-absolute bottom-0 end-0 mb-2 me-4 justify-items-center">
                                <i class="fa fa-paper-plane"></i>
                            </button>
                        </form>
                        @error('body')
                            <p class="p text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </form>
            @else
                <p>You need to log in to reply. <a href="/login">Click here.</a></p>

            @endauth

        {{-- REPLIES FOREACH LOOPS --}}
            @if ($replyCount > 0)
                @foreach ($replies as $reply)
                    @if ($reply->comment->id === $this->comment->id)
                        <div class="d-flex align-items-start">
                            <div class="position-absolute" style="width: 3rem;">
                                <a href="/profile/{{ $reply->author->id }}">
                                    <img class="img-fluid rounded-circle"
                                            style="width: 3rem; height: 3rem;"
                                            src="{{ !empty($reply->author->photo) ? url($reply->author->photo) : url('/img/no-image.png') }}"
                                            alt="...">
                                </a>
                            </div>
                            <div class="ms-5 p-2">
                                <a href="/profile/{{ $reply->author->id }}">
                                    <div class="fw-bold">{{ $reply->author->name }}</div>
                                </a>
                                {{ $reply->body }}
                                <div>
                                    <small>
                                        {{ $reply->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <p>No replies yet.</p>
            @endif
    </div>
</section>
