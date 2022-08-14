<?php

namespace App\Http\Livewire\Admin;

use App\Models\UserSession;
use Livewire\Component;

class UserSessionsList extends Component
{
    public function render()
    {
        $sessions = UserSession::whereNotNull('user_id')->get();

        return view('livewire.admin.user-sessions-list', compact('sessions'))->extends('layouts.master');
    }
}
