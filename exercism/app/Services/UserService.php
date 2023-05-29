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
    
        if (isset($data['address_id'])) {
            $address = Address::find($data['address_id']);
    
            if ($address) {
                $address->user_id = $user->id;
                $address->save();
            }
        }
    
        // $user->sendEmailVerificationNotification();
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
        $address->user_id = $user->id;
        $user->save();
        $address->save();

       // $user->sendEmailVerificationNotification();
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
        $user->notify(new CustomVerifyEmailNotification);
    }
}