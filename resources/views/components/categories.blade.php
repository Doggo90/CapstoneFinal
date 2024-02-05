<div class="card mt-4">
    <h4 class="text-center mt-2">Categories</h2>
    <div class="card-header pb-0 p-3 text-center">
        <ul class="list-group text-sm">
            @foreach($categories as $category)
            <a href="/category/{{ $category->id }}">
                <li class="list-group-item">{{ $category->name }}</li>
            </a>
            @endforeach
          </ul>
        {{-- <a href="/categories" class="mb-0">
            <br>
           <p class="h4 text-bold" class="">All Categories</p>
        </a> --}}
    </div>
    <div class="card-body p-3">

    </div>
</div>
