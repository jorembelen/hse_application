<?php

namespace App\Services;

use App\Models\User;

class GreetingService
{
    public static function getGreeting()
    {
        $greetings = "";
        $hour = date('H');

        if ($hour >= 18) {
            $greetings = "Good Evening";
        } elseif ($hour >= 12) {
            $greetings = "Good Afternoon";
        } elseif ($hour < 12) {
            $greetings = "Good Morning";
        }

        return $greetings;
    }

    public function getUserEmails($locationId) 
    {
        dd('here');
        $email = User::whereIn('role', ['super_admin', 'admin'])
        ->whereStatus(1)
        ->orWhere('location_id', $locationId)
        ->whereStatus(1)
        ->get()
        ->pluck('email');

        return $email;
    }


}
