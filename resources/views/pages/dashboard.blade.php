@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        {{-- START FEATURED POSTS || ANNOUCEMENTS --}}

        {{-- END FEATURED POSTS || ANNOUCEMENTS --}}
        <br>
        <div class="row mt-8">
            <div class="col-lg-9 mb-lg-0 mb-4">
                @auth
                <livewire:create-post />
                @endauth
                {{-- START POSTS LOOPINGS --}}
                @livewire('sort-button', ['posts' => $allposts])
                {{-- END POSTS LOOPINGS --}}
            </div>

            {{-- RIGHT SIDE COLUMN (ANNOUNCEMENTS AND WHATNOT) --}}
            <div class="col-lg-3 ">
                <div class="pb-0 p-3 text-center">
                    <a href="/categories" class="mb-0">
                        <br>
                       <p class="h4 text-bold" class="">Announcements</p>
                    </a>
                </div>
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
                <br>
                @endforeach

                {{-- CATEGORIES CARD --}}
                <div class="card">
                    <div class="card-header pb-0 p-3 text-center">
                        <a href="/categories" class="mb-0">
                            <br>
                           <p class="h4 text-bold" class="">All Categories</p>
                        </a>
                    </div>
                    <div class="card-body p-3">

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
    <script src="./assets/js/plugins/chartjs.min.js"></script>
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
