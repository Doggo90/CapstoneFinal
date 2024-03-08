<section class="mb-5">

    <div class="card bg-light">
        <div class="card-body">
            <!-- Comment form-->
            @auth

                <form wire:submit="createComment" class="row g-3 mb-4" action="">
                    @csrf
                    <div class="col-auto">
                        <a href="/profile/{{ auth()->user()->id }}"><img class="img-fluid rounded-circle"
                                style="width: 3rem; height: 3rem;"
                                src="{{ !empty(auth()->user()->photo) ? url(auth()->user()->photo) : url('/img/no-image.png') }}"
                                alt="profile">
                        </a>
                    </div>
                    <div class="col position-relative" x-data="{
                        open: false
                    }">
                        <textarea class="form-control" rows="2" name="comment_body" id="comment_body" wire:model="comment_body"
                            wire:model.live.debounce.500ms="search" @keydown.slash="open = true" @keydown.escape="open = false"
                            placeholder="Join the discussion and leave a comment!" wire:keydown.enter="createComment" maxlength='200'
                            minlength='10'>
                        </textarea>
                        <div x-show="open" @click.away="open = false" x-cloak>
                            <ul>
                                @php
                                preg_match_all('/\/\w+/',$comment_body, $matches);
                                $search = implode(' ', $matches[0]);
                                $results = App\Models\User::where('name', 'like', '%' . substr($search, 1) . '%')
                                ->orWhere('email', 'like', '%' . substr($search, 1) . '%')
                                ->get();
                                @endphp
                                {{-- <h1>{{ $search }}</h1> --}}
                                @foreach ($results as $result)
                                    <div class="random">
                                        <h1>PUTANG IAN MO</h1>
                                        <li wire:click="mentionUser('{{ $result->email }}')">
                                            <p class="text-sm font-medium text-black">{{ $result->name }}</p>
                                            <small>{{ $result->email }}</small>
                                        </li>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                        <button type="submit"
                            class="btn btn-success position-absolute bottom-0 end-0 mb-2 me-4 justify-items-center">
                            <i class="fa fa-paper-plane"></i>
                        </button>
                        @error('comment_body')
                            <p class="p text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <br>
                </form>
            @else
                <p>You need to log in to comment. <a href="/login">Click here.</a></p>

            @endauth {{-- (auth()->user()) END IF ^^^ --}}
            <!-- Comment with nested comments-->
            <div class="row">
                <h3>Comments ({{ $post->comments->count() }})</h3>
            </div>

            {{-- HELPFUL COMMENT FOREACH --}}
            @foreach ($comments as $comment)
                @if ($post->id == $comment->post_id)
                    @if ($comment->is_helpful == 1)
                        @php
                            $flag = true;
                            preg_match_all(
                                '/(?:^|\s)@(\w+)|(?:^|\s)(\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b)/',
                                $comment->comment_body,
                                $matches,
                            );
                            $users = array_unique($matches[1]);
                            $matchedUsers = \App\Models\User::where(function ($query) use ($users) {
                                foreach ($users as $user) {
                                    $query->orWhere('name', 'like', "%$user%");
                                }
                            })->get();
                            // dd($users);
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

                                        <p>
                                            @foreach ($matchedUsers as $user)
                                                @php
                                                    $username = $user->name;
                                                    $profileLink = $user->profile_link;
                                                    $commentBody = str_replace(
                                                        '@' . $username,
                                                        '<a href="' . $profileLink . '">@' . $username . '</a>',
                                                        $comment->comment_body,
                                                    );
                                                @endphp
                                            @endforeach
                                            {!! $commentBody !!}
                                        </p>

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
                        <div x-data="{ open: false }" class="d-flex flex-column">
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
                                <div>
                                    <p>
                                        @php
                                            preg_match_all(
                                                '/(?:^|\s)@(\w+)|(?:^|\s)(\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b)/',
                                                $comment->comment_body,
                                                $matches,
                                            );
                                            $users = array_unique($matches[1]);
                                            $matchedUsers = \App\Models\User::where(function ($query) use ($users) {
                                                foreach ($users as $user) {
                                                    $query
                                                        ->orWhere('name', 'like', "%$user%")
                                                        ->orWhere('email', 'like', "%$user%");
                                                }
                                            })->get();
                                            // dd($matchedUsers);
                                            $modifiedCommentBody = $comment->comment_body;
                                        //    dd($users);
                                        @endphp


                                        @foreach ($matchedUsers as $user1)
                                            @php

                                                $username = $user1->name;
                                                // dd($user);
                                                $profileLink = route('profile', ['id' => $user1->id]);
                                                $modifiedCommentBody = str_replace(
                                                    '@' . $username,
                                                    '<a href="' . $profileLink . '">@' . $username . '</a>',
                                                    $modifiedCommentBody,
                                                );
                                            @endphp
                                            <h1>{{ $user1 }}</h1>
                                            <br>
                                        @endforeach


                                        {!! $modifiedCommentBody !!}
                                    </p>
                                </div>
                                <div>
                                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
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
                                <livewire:reply-section :key="$comment->id" :$comment />
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
