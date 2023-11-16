<div>
    @auth
        @if (auth()->user()->role == 'admin')
            <div class="form-check form-switch">
                <input wire:click="toggleArchive()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" wire:model="post.is_archived" {{ ($this->post->is_archived == 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="flexSwitchCheckDefault">Archive Post</label>
            </div>
        @endif
    @endauth
</div>
