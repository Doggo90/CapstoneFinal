<div class="card mx-5">
    <style>
        .custom-button{
            margin: 0;
            position: relative;
        }

    </style>
    <!-- Button trigger modal -->
    <button type="button" class="block text-white bg-green-500 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-green-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-500 dark:focus:ring-green-500 custom-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        What's on your mind?
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <br><br>
                    <h1 class="modal-title fs-5 ms-auto" id="staticBackdropLabel">Think Before You Click.</h1>
                    <button type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800" data-bs-dismiss="modal">X</button>
                </div>
                <div class="modal-body">
                    <br>
                    <form wire:submit.prevent="createPost" class="row g-3 mb-0" action="" wire:ignore>
                        @csrf
                        <div class="row mb-2 ms-auto">
                            <input class="form-control mb-3" rows="3" name="title" id="title"
                                wire:model="title" placeholder="Post Title. ">
                            @error('title')
                                <p class="p text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <input class="form-control mb-3" rows="3" name="tags" id="tags"
                                wire:model="tags" placeholder="Tags(Comma Separated)">
                            @error('tags')
                                <p class="p text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <select class="form-select mb-3" aria-label="multiple select example"name="selectedCategories" id="selectedCategories" wire:model="selectedCategories">
                                <option selected>Select a category...</option>
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }} </option>
                                @endforeach
                            </select>
                            @error('selectedCategories')
                                <p class="p text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                        </div>
                        <div class="row mb-2 ms-auto">
                            <textarea class="form-control mb-0 pb-0" rows="3" name="body" id="body" wire:model="body"
                                placeholder="Post Context"></textarea>
                            @error('body')
                                <p class="p text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" wire:click="createPost" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Submit Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
