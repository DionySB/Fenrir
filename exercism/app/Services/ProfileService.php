<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\User;

class ProfileService
{
    public function createProfile(User $user, array $data)
    {
        $profile = Profile::create($data);
        
        $profile->user_id = $user->id;
        $profile->save();

        $user->profile_id = $profile->id;
        $user->save();
    }
}