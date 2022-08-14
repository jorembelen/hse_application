<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavbarComponent extends Component
{
    protected $listeners = ['refreshProfile' => '$refresh'];

    public function render()
    {
        return view('livewire.navbar-component');
    }
}
