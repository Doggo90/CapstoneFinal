<div class="mb-2">
    <h4 class="text-center mt-2">Categories</h2>
    <div class="card">
            <div class="card-body pb-0 p-3 text-center">
                <ul class=" text-sm ps-0" style="list-style-type: none;">
                    @foreach ($categories as $category)
                        <a href="/category/{{ $category->id }}">
                            <li class="">{{ $category->name }}</li>
                        </a>
                    @endforeach
                </ul>
            </div>
    </div>
</div>
