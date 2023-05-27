<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\User;

class ProfileService
{
    public function createProfile(User $user, array $data)
    {
        // Criar o perfil associado ao usuário
        $profile = Profile::create($data);
        
        // Associar o perfil ao usuário
        $profile->user_id = $user->id;
        $profile->save();

        $user->profile_id = $profile->id;
        $user->save();
        }
    }