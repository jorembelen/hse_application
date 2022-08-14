<?php

namespace App\Http\Livewire\Manager;

use App\Models\RootCause;
use Livewire\Component;
use Livewire\WithPagination;

class Recommendations extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $query;
    protected $queryString = ['query'];

    public function updated($property)
    {
        if ($property === 'query') {
            $this->resetPage();
        }
    }

    public function render()
    {
        $cause = RootCause::search($this->query)->latest()->paginate(10);
        session()->put('previousRoute', url()->previous());

        return view('livewire.manager.recommendations', compact('cause'))->extends('layouts.master');
    }
}
