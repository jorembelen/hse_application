

@props(['model', 'name', 'direction', 'label'])

{{ $label }}
<span wire:click="sortBy('{{ $model }}')" class="mt-2 text-sm" style="cursor: pointer;">
    <i class="fa fa-arrow-up {{ $name === $model && $direction === 'asc' ? '' : 'text-muted' }}"></i>
    <i class="fa fa-arrow-down {{ $name === $model && $direction === 'desc' ? '' : 'text-muted' }}"></i>
</span>