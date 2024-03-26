@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Your Profile'])
    {{-- REPUTATION DISPLAY AND POSTS COUNT START --}}
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-lg-12 col-md-12 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item mb-0 px-0 py-1 active d-flex align-items-center justify-content-center ">
                                    <i class="fa fa-star"></i>
                                    <span class="ms-2">Reputation: {{$user->reputation}}</span>
                            </li>
                            <li class="nav-item mb-0 px-0 py-1 active d-flex align-items-center justify-content-center ">
                                    <i class="fa fa-star"></i>
                                    <span class="ms-2">Total Reputation: {{$user->total_reputation}}</span>
                            </li>
                            <li class="nav-item mb-0 px-0 py-1 d-flex align-items-center justify-content-center ">
                                    <i class="fa fa-folder-open"></i>
                                    <span class="ms-2">Posts: {{$user->posts()->count()}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- REPUTATION DISPLAY AND POSTS COUNT END --}}
    <div id="alert">
        @include('components.alert')
    </div>
<br>
    <div class="container-fluid py-4">
        {{-- USER DETAILS START --}}
        <div class="row justify-content-center">
                <div class="col-md-8 align-items-center">
                    <div class="card card-profile ">
                        <div class="row justify-content-center">
                            <div class="col-4 col-lg-4 order-lg-2 d-flex justify-content-center align-items-center">
                                <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                    <img src="{{ (!empty($user->photo)) ? url($user->photo) : url('/img/no-image.png')}}" alt="profile_image" class="rounded-circle img-fluid border border-2 border-white" width="200" height="200">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col">
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <h5>
                                    {{$user->name}}
                                </h5>
                                <div class="h6 font-weight-300">
                                    <i class="ni location_pin mr-2"></i>{{$user->email}}
                                </div>
                                <div>
                                    <strong>Organization</strong>
                                </div>
                                <div class="h6">
                                    {{$user->organizations->name ?? 'This user has yet to set their org.'}}
                                </div>
                                <div class="h6">
                                   <strong>({{$user->organizations->nickname ?? 'This user has yet to set their org.'}})
                                    </strong>
                                </div>
                                <div>
                                    <strong>Bio</strong>
                                </div>
                                <div class="h6">
                                    {{$user->bio ?? 'This user has yet to set their bio.'}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
        {{-- USER DETAILS END --}}


        {{-- USER DETAILS FORM START --}}
        <div class="row justify-content-center">
            <div class="col-md-8 align-items-center">

                @if (auth()->user()->id == $user->id)
                    <div class="card">
                        <form role="form" method="POST" action="{{ route('profile.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">Edit Profile</p>
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-uppercase text-sm">User Information</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Name</label>
                                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Email address</label>
                                            <input class="form-control" type="email" name="email" value="{{ old('email', auth()->user()->email) }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Contact Information</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Address</label>
                                            <input class="form-control" type="text" name="address"
                                                value="{{ old('address', auth()->user()->address) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Phone</label>
                                            <input class="form-control" type="number" name="phone" value="{{ old('phone', auth()->user()->phone)}}">
                                        </div>
                                    </div>
                                </div>
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">About me</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Bio</label>
                                            <textarea class="form-control" type="text" name="bio" id="bio"
                                                value="{{ old('bio', auth()->user()->bio) }}" placeholder="Please enter something about yourself."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>

        </div>
        {{-- USER DETAILS FORM END --}}

        <br><br>
        {{-- USERS POSTS LIST/HISTORY START--}}
        <div class="row justify-content-center">
            <div class="col-md-8 align-items-center">
                <div class="card card-profile">
                    <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3 mt-3">
                        <h3>Posts</h3>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex mx-auto">
                                    <div class="d-grid">
                                        @php $posts = $user->posts; @endphp
                                        @foreach ($posts as $post)
                                        <a href="/post/{{$post->id}}">
                                            <div class="col-lg-12 col-xs-12 d-flex justify-items-between mb-2">
                                                <div class="col-10 p-2 me-5">
                                                    <span class="text-lg font-weight-bolder">{{ \Illuminate\Support\Str::limit($post->title, $limit = 30, $end = '...') }}
                                                    </span>
                                                    <br>
                                                    <small>{{$post->created_at->diffForHumans()}}</small>
                                                </div>
                                                <div class="col-lg-4 d-flex justify-items-end hidden-lg-down d-none d-sm-inline-flex">
                                                    <p class="mb-0 p-2">
                                                        <i class="fa fa-arrow-up text-success me-2"></i>
                                                        <span class="font-weight-bold">{{ $post->likes()->count() }}</span>
                                                    </p>
                                                    <p class="mb-0 p-2">
                                                        <i class="fa fa-comment text-success me-2"></i>
                                                        <span class="font-weight-bold">{{ $post->comments()->count() }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        {{-- USERS POSTS LIST/HISTORY END --}}
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
