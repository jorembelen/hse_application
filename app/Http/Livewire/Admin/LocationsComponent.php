<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\BaseComponent;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class LocationsComponent extends BaseComponent
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $query, $locationId, $division, $name, $loc_name;
    public $listeners = [
        'delete'
    ];
    protected $queryString = ['query'];

    public function updated($property)
    {
        if ($property === 'query') {
            $this->resetPage();
        }
    }

    public function render()
    {
        $records = new Location();

        // Base query
        $query = $records->orderBy($this->sortColumnName, $this->sortDirection);

        // If a search query is provided, add it as a condition
        if ($this->query) {
            if(strlen($this->query) > 3) {
                $query->search($this->query);
            }
        }

        $total = $query->count();
        $locations = $query->paginate(10);

        session()->put('previousRoute', url()->previous());

        return view('livewire.admin.locations-component', compact('locations', 'total'))->extends('layouts.master');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-modal');
        $this->resetValidation();
        $this->division = null;
        $this->name = null;
        $this->loc_name = null;
    }

    public function showCreate()
    {
        $this->dispatchBrowserEvent('show-create-modal');
    }

    public function showEdit(Location $location)
    {
        $this->dispatchBrowserEvent('show-modal');
        $this->locationId = $location->id;
        $this->division = $location->division;
        $this->name = $location->name;
        $this->loc_name = $location->loc_name;
    }

    public function submit(Location $location)
    {
        $data = $this->validate([
            'division' => 'required',
            'name' => 'required',
            'loc_name' => 'required',
        ], [
            'loc_name.required' => 'Location name field is required.',
        ]);

        DB::beginTransaction();
        if($data) {
            $location->update($data);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Data was successfully updated.',
                'text' => '',
            ]);

            $this->close();
            return;
        }else{
            DB::rollBack();
        }
    }

    public function create()
    {
        $data = $this->validate([
            'division' => 'required',
            'name' => 'required',
            'loc_name' => 'required',
        ], [
            'loc_name.required' => 'Location name field is required.',
        ]);

        DB::beginTransaction();
        if($data) {
            Location::create($data);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Data was successfully added.',
                'text' => '',
            ]);

            $this->close();
            return;
        }else{
            DB::rollBack();
        }
    }

    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'message' => 'Are you sure?',
            'text' => 'Are you sure? Please confirm to proceed.',
            'id' => $id
        ]);
    }

    public function delete(Location $location)
    {
        if($location->incident->count() > 0) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Sorry, this location has an existing notification report!',
                'text' => '',
            ]);

            $this->close();
            return;

        }

        $location->delete();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Location was successfully deleted!',
            'text' => '',
        ]);

        $this->close();
    }

}
