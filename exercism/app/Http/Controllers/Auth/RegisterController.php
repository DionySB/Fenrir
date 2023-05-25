<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function showRegisterForm()
    {
        $provinces = DB::table('provinces')->pluck('name');
        return view('auth.register', compact('provinces'));
    }

    public function register(UserRequest $request)
    {
        $errors = $request->validated();
    
        if ($errors) {
            return redirect()->route('register')->withErrors($errors)->withInput();
        }
        
        $user = $this->userService->createUser($request->all());
    
        return redirect()->route('profile.create');
    }
    

}
