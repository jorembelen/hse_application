
@props(['name'])

<div class="row">
    <div class="col-md-6">
        <h4>{{ $name }}</h4>
    </div>
    <div class="col-md-6">
        <a class="btn btn-dark float-right" href="#" wire:click.prevent="showCreate"><i class="fas fa-plus-circle"></i> Add</a>
    </div>
</div>