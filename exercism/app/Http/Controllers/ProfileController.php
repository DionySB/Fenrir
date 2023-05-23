<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use lluminate\Database\Eloquent\Relations\HasOne;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function create()
    {
        return view('profiles.createProfile');
    }
    
    public function store(Request $request)
    {
        $user = auth()->user();
    
        if ($user) {
            $profile = new Profile();
            
            $profile->username = $request->input('username');
            $profile->gender = $request->input('gender');
            $profile->birth_date = $request->input('birth_date');
            if ($request->hasFile('profile_image')) {
                $profileImage = $request->file('profile_image');
                $profileImage->store('public/profiles'); 
                $profile->profile_image = $profileImage->hashName();
            }
    
            $profile->user_id = $user->id;
            $profile->save();

            $user->profile_id = $profile->id;
            $user->save();
        }
    
        return redirect()->route('home');
    }
    
}
