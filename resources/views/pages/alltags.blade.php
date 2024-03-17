@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                @include('components.announcements')
                @php
                    use App\Models\Post;
                    $mostLikedPost = Post::withCount('likes')
                        ->where('is_archived', false)
                        ->orderBy('likes_count', 'desc')
                        ->first();
                    $hottestPost = Post::withCount('comments')
                        ->where('is_archived', false)
                        ->orderBy('comments_count', 'desc')
                        ->first();
                    // dd($hottestPost);
                    // dd($mostLikedPost);
                @endphp
                <a href="/post/{{ $mostLikedPost->id }}">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Most Upvoted Post</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $mostLikedPost->title }}

                                        </h5>
                                        <p class="mb-0">
                                            <i class="fa fa-arrow-up text-success me-2"></i>
                                            <span class="font-weight-bold">{{ $mostLikedPost->likes()->count() }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                                        <i class="ni ni-like-2 text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <br>
                <a href="/post/{{ $hottestPost->id }}">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">HOTTEST POST</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $hottestPost->title }}
                                        </h5>
                                        <p class="mb-0">
                                            <i class="fa fa-comment text-success me-2"></i>
                                            <span class="font-weight-bold">{{ $hottestPost->comments()->count() }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-danger text-center rounded-circle">
                                        <i class="ni ni-chat-round text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <br>
            </div>
            {{-- END FEATURED POSTS || ANNOUCEMENTS --}}
            <div class="col-lg-6 mb-lg-0 mb-4">
                @auth
                    <livewire:create-post />
                @endauth
                {{-- START POSTS LOOPINGS --}}
                <style>
                    .custom-button {
                        margin: 0;
                    }
                </style>
                <br>
                <div class="card">
                    <div class="card-body">
                        @foreach ($posts as $post)
                            @if ($post->is_archived == 0 && $post->is_approved)
                                <a href="/post/{{ $post->id }}">
                                    <div class="card z-index-2" style="max-height: 200px; overflow: hidden;">
                                        <div class="card-header pb-0 pt-3 bg-transparent d-flex justify-content-start mx-3">
                                            <p class="text-capitalize text-bold">
                                                <img class="img-fluid rounded-circle" style="width: 2rem; height: 2rem;"
                                                    src="{{ !empty($post->author->photo) ? url($post->author->photo) : url('/img/no-image.png') }}"
                                                    alt="profile">
                                                {{ $post->author->name }}
                                            </p>
                                        </div>
                                        <div class="card-body d-flex justify-content-between mx-4 mb-4"
                                            style="max-height: 100px; overflow: hidden; margin-bottom: 0; margin-left: 0; margin-right: 0;">
                                            <div>
                                                <p class="text-uppercase fw-bold">
                                                    {{ \Illuminate\Support\Str::limit(explode('å', $post->title)[0], $limit = 40, $end = '...') }}
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <i class="fa fa-arrow-up text-success me-3"></i>
                                                    <span class="font-weight-bold">{{ $post->likes()->count() }}</span>
                                                    <i class="fa fa-comment text-success ms-3 me-3"></i>
                                                    <span class="font-weight-bold">{{ $post->comments->count() }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-start p-3 mx-4 my-2"
                                            style="max-height: 100px; padding-top: 0; margin-top: 0;">
                                            <p class="text-sm mb-0">
                                                <i class="fa fa-clock text-success"></i>
                                                <span class="font-weight-bold">
                                                    {{ $post->created_at->diffForHumans() }}</span>
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
                <br>
                {{-- END POSTS LOOPINGS --}}
            </div>
            <div class="col-lg-3">
                @include('components.categories')
                <div class="card mt-2 ">
                    <div class="card-header">
                        <h5 class="text-center">Rankings (Reputation)</h5>
                    </div>
                    @foreach ($topRep as $top)
                        <a href="/profile/{{ $top->id }}">
                            <div class="card-body d-flex justify-content-between pb-0"
                                style="padding-bottom: 0; padding-top: 0;">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ (!empty($top->photo)) ? url($top->photo) : url('/img/no-image.png')}}" alt="profile_image" class="rounded-circle img-fluid border-white pb-4" width="40" height="40">
                                    <p class="text-bold ms-3">
                                        {{ \Illuminate\Support\Str::limit(explode(' ', $top->name)[0], $limit = 15, $end = '...') }}
                                        <span>
                                            ({{ $top->organizations->nickname }})
                                        </span>
                                    </p>
                                </div>

                                <p class="text-bold">{{ $top->reputation }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
            @livewireScripts

        </div>
        <div class="row">
            <div class="col-lg-7 mb-lg-0 mb-4">
            </div>
            @include('layouts.footers.auth.footer')
        </div>
    </div>
@endsection
