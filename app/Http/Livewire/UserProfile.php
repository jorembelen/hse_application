<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserProfile extends Component
{
    use WithFileUploads;
    public $userId, $email, $name, $username, $password, $password_confirmation, $profile_pic, $iteration;
    public $editPass = false;
    public $showPass = false;
    public $newProfile = false;
    protected $listeners = ['refreshProfile' => '$refresh'];

    public function render()
    {
        return view('livewire.user-profile')->extends('layouts.master');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-modal');
        $this->resetValidation();
        $this->email = null;
        $this->name = null;
        $this->username = null;
        $this->profile_pic = null;
        $this->iteration++;
        $this->newProfile = false;
        $this->password = null;
        $this->password_confirmation = null;
        $this->editPass = false;
        $this->showPass = false;
    }

    public function editPassword()
    {
        $this->editPass = !$this->editPass;
    }

    public function showEdit(User $user)
    {
        $this->dispatchBrowserEvent('show-modal');
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
    }

    public function submit(User $user)
    {
        $data = $this->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' .$this->userId,
            'email' => 'required|email|unique:users,email,' .$this->userId,
        ]);

        if($this->password){
            $data = $this->validate([
                'password' => 'nullable|confirmed',
            ]);
        }

        if($this->profile_pic){
            $this->newProfile = 1;
            $data = $this->validate([
                'profile_pic' => 'image',
            ]);
        }

        DB::beginTransaction();
        if($user){
            $data['newProfile'] = $this->newProfile;
            $user->updateProfile($data);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Your profile was updated successfully.',
                'text' => '',
            ]);
            $this->close();
            $this->emit('refreshProfile');
            return;
        }else{
            DB::rollBack();
            return redirect()->back();
        }

    }

}
