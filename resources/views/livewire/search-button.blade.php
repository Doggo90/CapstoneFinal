<div class="input-group">
    <form wire:submit.prevent="search" class="input-group">
        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
        <input type="text" wire:model="search" name="search" id="search" class="form-control" placeholder="Type here...">
    </form>
</div>
