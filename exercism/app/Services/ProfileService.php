<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\User;

class ProfileService
{
    public function createProfile(User $user, array $data)
    {
        $profile = new Profile();

        $profile->username = $data['username'];
        $profile->gender = $data['gender'];
        $profile->birth_date = $data['birth_date'];

        if ($data['profile_image']) {
            $profileImage = $data['profile_image'];
            $profileImage->store('public/profiles'); 
            $profile->profile_image = $profileImage->hashName();
        }

        $profile->user_id = $user->id;
        $profile->save();
    }
}