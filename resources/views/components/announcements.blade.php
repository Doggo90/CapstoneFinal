
    <div class="pb-0 p-3 text-center">
        <a href="/categories" class="mb-0 ">
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
