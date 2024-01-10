
<div>
    @livewireStyles
    <div x-data = "{
        query: ''
    }" id="search-box">
        {{-- <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span> --}}
        <input class="input-group-text text-body" x-model="query" type="text" wire:model.live.debounce.300ms="search" name="search" id="search" placeholder="Search here...">
        <button x-on:click="$dispatch('search',{
                search : query
            })"
            type="button" class="btn btn-success">
            Search
        </button>
    </div>

    <div class="card">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
            <label class="btn btn-outline-success" for="btnradio1" wire:click="setSortBy('created_at')">Latest</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
            <label class="btn btn-outline-success" for="btnradio2" wire:click="setSortBy('likes_count')">Upvotes</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
            <label class="btn btn-outline-success" for="btnradio3" wire:click="setSortBy('comments_count')">Comments</label>
        </div>
        <div class="card-body">
            @foreach($posts as $post)
                @if ($post->is_archived == 0)
                    <a href="/post/{{$post->id}}">
                        <div class="card z-index-2" style="max-height: 200px; overflow: hidden;"    >
                            <div class="card-header pb-0 pt-3 bg-transparent">
                                <h6 class="text-capitalize ">
                                    <img class="img-fluid rounded-circle" style="width: 2rem; height: 2rem;" src="{{ (!empty($post->author->photo)) ? url($post->author->photo) : url('/img/no-image.png')}}" alt="profile">
                                    {{$post->author->name}}</h6>
                                <p class="text-sm mb-0">
                                    <i class="fa fa-clock text-success"></i>
                                    <span class="font-weight-bold"> {{$post->created_at->diffForHumans()}}</span>
                                </p>
                            </div>
                            <div class="card-body p-3" style="max-height: 100px; overflow: hidden;">
                                <h4 class="text-uppercase fw-bold">{{$post->title}}</h4>
                            </div>
                            <div class="card-footer p-3" style="max-height: 100px;">
                                <p>
                                    <i class="fa fa-arrow-up text-success me-2"></i>
                                    <span class="font-weight-bold">{{$post->likes()->count()}}</span>
                                    <i class="fa fa-comment text-success ms-3 me-2"></i>
                                    <span class="font-weight-bold">{{$post->comments->count()}}</span>
                                </p>
                            </div>
                        </div>
                    </a>
                    <br>
                @endif
            @endforeach
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-center inline-block">
                {{ $posts->withQueryString()->links() }}
            </div>
        </div>
    </div>
    @livewireScripts
</div>
