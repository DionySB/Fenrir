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
    
        // Verificar se o usuário já possui um perfil
        if ($user->profile) {
            return redirect()->route('home')->with('message', 'Você já possui um perfil.');
        }
    
        // Validar os dados do perfil

        $request->validate($request->profileRules(), $request->messages());

        $data = $request->all();
        // Criar o perfil

        $this->profileService->createProfile($user, $data);
    
        return redirect()->route('home')->with('message', 'Perfil criado com sucesso.');
    }
    
    
}
