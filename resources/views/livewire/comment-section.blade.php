<section class="mb-5">

    <div class="card bg-light">
        <div class="card-body">
            <!-- Comment form-->
            @auth
                <form wire:submit="createComment" class="row g-3 mb-4" action="">
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
                            <textarea
                            class="form-control" rows="2" name="comment_body" id="comment_body" wire:model.live="comment_body"
                            placeholder="Join the discussion and leave a comment!" wire:keydown.enter="createComment">
                            </textarea>
                                <button type="submit"
                                class="btn btn-success position-absolute bottom-0 end-0 mb-2 me-4 justify-items-center">
                                <i class="fa fa-paper-plane"></i>
                            </button>
                        </form>
                        @error('comment_body')
                            <p class="p text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- <div class="col position-relative" x-data="{open: false, query: ''}">
                        <input type="text" x-model="query" name="query" id="query" @keyup.slash="open = true"  @keydown.escape="open = false" x-if="open" wire:model.live="search">
                        <button x-on:click="open = !open, $dispatch('search', { search: query }, console.log(query))">search</button>
                        <ul x-show="open">
                            @foreach($users as $user)
                                <li>{{ $user->name }}</li>
                            @endforeach
                        </ul>
                    </div> --}}
                    {{-- <input type="hidden" name="post_id" value="{{ $this->post->id }}">
                                <input type="hidden" name="user_id" value="{{ $this->$post->user_id }}"> --}}
                    <br>
                </form>
            @else
                <p>You need to log in to comment. <a href="/login">Click here.</a></p>

            @endauth {{-- (auth()->user()) END IF ^^^ --}}
            <!-- Comment with nested comments-->

            <div class="row">
                @php

                @endphp
                <h3>Comments ({{ $post->comments->count() }})</h3>
            </div>

            {{-- HELPFUL COMMENT FOREACH --}}
            @foreach ($comments as $comment)
                @if ($post->id == $comment->post_id)
                    @if ($comment->is_helpful == 1)
                        @php
                            $flag = true;
                        @endphp
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="text-center">
                                    This comment is marked as helpful by the author.
                                </h5>
                            </div>
                            <div class="card-body d-flex justify-content-center">
                                <div class="d-flex mb-4">
                                    <!-- Parent comment-->
                                    <a href="/profile/{{ $comment->author->id }}">
                                        <div class="flex-shrink-0"><img class="img-fluid rounded-circle"
                                                style="width: 3rem; height: 3rem;"
                                                src="{{ !empty($comment->author->photo) ? url($comment->author->photo) : url('/img/no-image.png') }}"
                                                alt="..."></div>
                                    </a>
                                    <div class="ms-3">
                                        <a href="/profile/{{ $comment->author->id }}">
                                            <div class="fw-bold">{{ $comment->author->name }}</div>
                                            <livewire:is-helpful :comment="$comment" />
                                        </a>
                                        {{ $comment->comment_body }}
                                        <!-- Child comment -->
                                        <div>
                                            <small>
                                                {{ $comment->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
            {{-- REST OF COMMENTS --}}
            {{-- @php
                dd($flag);
            @endphp --}}
            @foreach ($comments as $comment)
                @if ($comment->post_id === $this->post->id)
                    @if ($comment->is_helpful == 0)
                    <div x-data="{open: false}" class="d-flex flex-column">
                        <!-- Image -->
                        <div class="flex-shrink-0 position-absolute">
                            <a href="/profile/{{ $comment->author->id }}">
                                <img class="img-fluid rounded-circle" style="width: 3rem; height: 3rem;"
                                    src="{{ !empty($comment->author->photo) ? url($comment->author->photo) : url('/img/no-image.png') }}"
                                    alt="...">
                            </a>
                        </div>
                        <!-- Content -->
                        <div class="ms-5 p-2 mt-0 d-flex flex-column w-100">
                            <div>
                                <!-- Author name and helpful section -->
                                <a href="/profile/{{ $comment->author->id }}">
                                    <div class="fw-bold">{{ $comment->author->name }}</div>
                                    @if ($flag == false)
                                        <livewire:is-helpful :comment="$comment" />
                                    @endif
                                </a>
                            </div>
                            <!-- Comment body -->
                            <div>{{ $comment->comment_body }}</div>
                            <!-- Child comment -->
                            <div>
                                <small>{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                            <!-- Replies link -->
                            <div x-on:click="open = !open">
                                <i class="fa fa-arrow-right ms-3 me-2"></i>
                                <span>
                                    <small>
                                        <a href="#section-{{ $comment->id }}">
                                            Replies ({{ $comment->reply->count() }})
                                        </a>
                                    </small>
                                </span>
                            </div>
                        </div>
                        <!-- Replies section -->
                        <div x-show="open" x-cloak class="ms-2 w-100">
                            <livewire:reply-section :key="$comment->id" :$comment/>
                        </div>
                    </div>
                    @endif
                @endif
            @endforeach
    </div>
        <script>
            // Watch for changes in the query and remove the first slash
            $watch('query', (value) => {
                if (value.startsWith('/')) {
                    query = value.substring(1);
                }
            });
        </script>
</section>

