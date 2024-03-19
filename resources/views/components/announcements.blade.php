<div class="pb-0 ">
    <p class="h4 text-bold text-center mt-2">Announcements</p>
    @foreach ($announcements as $announcement)
    <div class="card z-index-2 mb-2 mt-2 " style="max-height: 200px; overflow: hidden;">
            <a href="/announcement/{{ $announcement->id }}">
                <div class="card-body pb-0 pt-2 bg-transparent ">
                    <h4 class="text-capitalize pb-0 mb-0">
                        {{ $announcement->title }}
                    </h4>
                    <p class="text-sm mb-0">
                        <i class="fa fa-clock text-success"></i>
                        <span class="font-weight-bold">{{ $announcement->created_at->diffForHumans() }}</span>
                    </p>
                </div>
                <div class="card-footer px-4 pt-0 pb-2">
                    <small>Click here for info.</small>
                </div>
            </a>
        </div>
        @endforeach
</div>
