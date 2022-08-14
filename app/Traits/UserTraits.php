<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait UserTraits {

    public function updateProfile($data)
    {
        $user = User::find(auth()->id());

        // dd($data);
        if($data['newProfile'] === 1){
            $img = $data['profile_pic'];
            $ImageUpload = Image::make($img);
            $name = $img->hashName();
            $storagePath = 'files/avatar/';
            $ImageUpload->fit(192)->stream();
            Storage::disk('local')->put($storagePath .$name, $ImageUpload->__toString());

            // Delete the old Image from the file
            if($user->profile_pic) {
                Storage::disk('local')->delete(parse_url($storagePath .$user->profile_pic));
            }
            $data['profile_pic'] = $name;
        }

        $user->update($data);

    }

}
