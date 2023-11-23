@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row mt-4">

            {{-- START POSTS LOOPINGS --}}
            <div class="col-lg-9 mb-lg-0 mb-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Post title-->
                                <h2 class="fw-bolder mb-1">{{$post->title}}</h2>
                                <livewire:archive-button :post="$post" />
                                <!-- Post meta content-->
                                <div class="text-muted fst-italic mb-2">{{$post->created_at->diffForHumans()}} by
                                    <a href="/profile/{{$post->author->id}}">
                                        {{ \Illuminate\Support\Str::limit(explode(' ', $post->author->name)[0], $limit = 15, $end = ''). ' '}}<i class="fa fa-star"></i>{{$post->author->reputation}}</a>
                                </div>
                                <!-- Post categories-->
                                    {{-- <x-post-tags :tagsCsv="$post->tags"/> --}}
                                <ul class="flex list-inline">
                                    @foreach($categories->category as $category)
                                    <li class="badge bg-secondary text-decoration-none link-light list-inline-item">
                                        <a href="/category/{{$category->id}}" style="text-decoration: none; color:white; ">
                                        {{$category->name}}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-body">
                                <p class="fs-5 mb-4">
                                    {{$post->body}}
                                </p>
                            </div>
                            <div class="card-footer p-3" style="max-height: 60px; ">
                                <p>
                                    <livewire:upvote :key="$post->id" :$post />
                                    <i class="fa fa-comment text-success ms-3 me-2"></i>
                                    <span class="font-weight-bold">{{$post->comments_count}}</span>
                                </p>
                            </div>
                            <br>
                        </div>
                        <!-- Comments section-->

                        <livewire:comment-section :key="$post->id" :$post />
                    </div>
                </div>

            </div>
            {{-- END POSTS LOOPINGS --}}


            {{-- RIGHT SIDE COLUMN (ANNOUNCEMENTS AND CATEGORIES ETC.) --}}
            <div class="col-lg-3 ">
                @foreach ($announcements as $announcement )

                <a href="/announcement/{{$announcement->id}}">
                    <div class="card z-index-2" style="max-height: 200px; overflow: hidden;">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h4 class="text-capitalize">
                                {{$announcement->title}}
                                </h4    >
                            <p class="text-sm mb-0">
                                <i class="fa fa-clock text-success"></i>
                                <span class="font-weight-bold">{{$announcement->created_at->diffForHumans()}}</span>
                            </p>
                        </div>
                        <div class="card-footer p-3">
                            <small>Click here for info.</small>
                        </div>
                    </div>
                </a>
                @endforeach
                <br>
                {{-- CATEGORIES CARD --}}
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Categories</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            @foreach ($categories1 as $category)
                            <a href="/category/{{$category->id}}">
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">{{$category->name}}</h6>
                                            <span class="text-xs">Contains {{$category->posts()->count()}} posts.</span>
                                        </div>
                                    </div>
                                </li>
                            </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
            </div>
        </div><br><br><br>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush


