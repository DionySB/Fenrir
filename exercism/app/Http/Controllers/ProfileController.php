<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Services\ProfileService;
use lluminate\Database\Eloquent\Relations\HasOne;
use App\Models\Profile;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function create()
    {
        return view('profiles.createProfile');
    }

    public function store(ProfileRequest $request)
    {
        $user = auth()->user();
    
        $request->validate($request->store(), $request->messages());
    
        $data = $request->all();
    
        $this->profileService->createProfile($user, $data);
    
        return redirect()->route('home')->with('message', 'Perfil criado com sucesso.');
    }
    
    
    
}
