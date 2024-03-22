<div class="mb-2" >
    <h4 class="text-center mt-2">Categories</h2>
    <div class="card" x-data="{ open: false, hide: false }">
            <div class="card-body pb-0 p-3 text-center">
                <ul class=" text-sm ps-0" style="list-style-type: none;">
                    @foreach ($categories as $category)
                        <a href="/category/{{ $category->id }}">
                            <li class=""><strong>{{ $category->name }}</strong></li>
                        </a>
                    @endforeach
                    <li><a href="#" class="badge bg-success" x-on:click="open = !open, hide=!hide" x-show="!open"><strong><i>Show All</i></strong></a></li>
                    <div x-cloak x-show="open" class="ease-in">

                        @foreach ($allCat as $category)
                        <a href="/category/{{ $category->id }}">
                            <li class=""><strong>{{ $category->name }}</strong></li>
                        </a>
                    @endforeach
                        <li><a href="#" class="badge bg-success" x-on:click="open = !open, hide=!hide"><strong><i>Show less</i></strong></a></a></li>
                    </div>
                </ul>
            </div>
    </div>
</div>
