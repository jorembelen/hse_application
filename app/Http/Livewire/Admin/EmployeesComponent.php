<?php

namespace App\Http\Livewire\Admin;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeesComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $query, $employeeId, $badge, $name, $designation;
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
        $employees = Employee::search($this->query)->latest()->paginate(10);

        return view('livewire.admin.employees-component', compact('employees'))->extends('layouts.master');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-modal');
        $this->resetValidation();
        $this->badge = null;
        $this->name = null;
        $this->designation = null;
    }

    public function showCreate()
    {
        $this->dispatchBrowserEvent('show-create-modal');
    }

    public function showEdit(Employee $employee)
    {
        $this->dispatchBrowserEvent('show-modal');
        $this->employeeId = $employee->id;
        $this->badge = $employee->badge;
        $this->name = $employee->name;
        $this->designation = $employee->designation;
    }

    public function submit(Employee $employee)
    {
        $data = $this->validate([
            'badge' => 'required|min:8|unique:employees,badge,' .$this->employeeId,
            'name' => 'required',
            'designation' => 'required',
        ]);

        DB::beginTransaction();
        if($data) {
            $employee->update($data);
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
            'badge' => 'required|min:8|unique:employees,badge',
            'name' => 'required',
            'designation' => 'required',
        ]);

        DB::beginTransaction();
        if($data) {
            Employee::create($data);
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

    public function delete(Employee $employee)
    {
        if($employee->incidents->count() > 0) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Sorry, this employee has an existing notification report!',
                'text' => '',
            ]);

            $this->close();
            return;

        }

        $employee->delete();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => $employee->name .' was successfully deleted!',
            'text' => '',
        ]);

        $this->close();
    }

}
