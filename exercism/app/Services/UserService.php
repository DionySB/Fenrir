<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserService
{
    public function registerUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return $user;
    }

    public function updateUser(User $user, array $data)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            if ($data['password_confirmation'] != $data['password']) {
                return ['error' => 'Password confirmation does not match'];
            }
            $user->password = bcrypt($data['password']);
            unset($data['password']);
            unset($data['password_confirmation']);
        }
        $user->fill($data);
        $user->save();

        return $user;
    }
}