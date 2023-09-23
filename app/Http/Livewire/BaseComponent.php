<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class BaseComponent extends Component
{
	use WithPagination;
    
    public $search;
	public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    protected $queryString = ['search'];
	protected $paginationTheme = 'bootstrap';

    public function updated($property)
    {
        if ($property === 'search') {
            $this->resetPage();
        }
    }

	public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

}
