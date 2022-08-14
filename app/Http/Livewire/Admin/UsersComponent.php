<?php

namespace App\Http\Livewire\Admin;

use App\Mail\UserRegistrationMail;
use App\Models\Location;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class UsersComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $query, $userId, $email, $name, $username, $role, $location_id, $locationEdit;
    public $listeners = [
        'delete',
        'classChanged'
    ];
    protected $queryString = ['query'];

    public function classChanged($value)
    {
        $this->location_id = $value;
    }

    public function updated($property)
    {
        if ($property === 'query') {
            $this->resetPage();
        }
    }

    public function render()
    {
        $users = User::search($this->query)->latest()->paginate(10);
        $locations = Location::query()
            ->get(['id', 'name']);

        return view('livewire.admin.users-component', compact('users', 'locations'))->extends('layouts.master');
    }

    public function activate(User $user)
    {
        $user->update(['status' => 1]);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'User status was successfully activated.',
            'text' => '',
        ]);
        return;
    }

    public function deactivate(User $user)
    {
        $user->update(['status' => 0]);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'User status was successfully deactivated.',
            'text' => '',
        ]);
        return;
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-modal');
        $this->dispatchBrowserEvent('reApplySelect2');
        $this->resetValidation();
        $this->email = null;
        $this->name = null;
        $this->username = null;
        $this->role = null;
        $this->location_id = null;
    }

    public function showCreate()
    {
        $this->dispatchBrowserEvent('show-create-modal');
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function showEdit(User $user)
    {
        $this->dispatchBrowserEvent('show-modal');
        $this->dispatchBrowserEvent('reApplySelect2');
        $this->userId = $user->id;
        $this->email = $user->email;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->role = $user->role;
        $this->location_id = $user->location_id;
    }

    public function submit(User $user)
    {
        $data = $this->validate([
            'email' => 'required|email|min:8|unique:users,email,' .$this->userId,
            'name' => 'required',
            'role' => 'required',
            'locationEdit' => 'required_if:role,user',
            'username' => 'required|unique:users,username,' .$this->userId,
        ], [
            'location_id.required_if' => 'Please choose location.'
        ]);

        DB::beginTransaction();
        if($data) {
            $data['location_id'] = $this->locationEdit;
            $data['username'] = Str::lower($this->username);
            $data['email'] = Str::lower($this->email);
            $user->update($data);
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
            'email' => 'required|email|min:8|unique:users,email',
            'name' => 'required',
            'role' => 'required',
            'location_id' => 'required_if:role,user',
            'username' => 'required|unique:users,username',
        ], [
            'location_id.required_if' => 'Please choose location.'
        ]);

        DB::beginTransaction();
        if($data) {
            $data_pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $password = substr(str_shuffle(str_repeat($data_pool, 8)), 0, 8);
            $data['username'] = Str::lower($this->username);
            $data['email'] = Str::lower($this->email);
            $data['password'] = $password;
            $data['location_id'] = $this->location_id ? $this->location_id : null;
            // dd($data);
            $user = User::create($data);
            DB::commit();
            Mail::to($user->email)->send(new UserRegistrationMail($user, $password));
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

    public function delete(User $user)
    {
        if($user->incidents->count() > 0) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Sorry, this user has an existing notification report!',
                'text' => '',
            ]);

            $this->close();
            return;

        }

        $user->delete();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => $user->name .' was successfully deleted!',
            'text' => '',
        ]);

        $this->close();
    }

}
