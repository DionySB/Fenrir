<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Address;

class UserService
{

    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        
        $user = User::create($data);
        $user->save();
        $this->sendEmailVerification($user);

        return $user;
    }

    public function registerUser(array $data)
    {
        $addressData = $data['address'];
        unset($data['address']);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        $address = Address::create($addressData);

        $user->address_id = $address->id;
        $user->save();

        $user->address = $address;

        $this->sendEmailVerification($user);

        return $user;
    }



    public function updateUser(User $user, array $data)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            if ($data['password_confirmation'] != $data['password']) {
                throw ValidationException::withMessages(['password_confirmation' => 'Password confirmation does not match']);
            }
            $user->password = Hash::make($data['password']);
            unset($data['password']);
            unset($data['password_confirmation']);
        }
        $user->fill($data);
        $user->save();
    }
    
    private function sendEmailVerification(User $user)
    {
        $user->sendEmailVerificationNotification();
    }
}