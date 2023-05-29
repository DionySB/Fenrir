<?php

namespace App\Http\Controllers\Auth;

use App\Models\Address;
use App\Models\Province;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class RegisterController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function showRegisterForm()
    {
        $provinces = Province::pluck('name');
        return view('auth.register', compact('provinces'));
    }

    public function register(RegisterRequest $request)
    {
        $request->validate($request->registerRules(), $request->messages());

        $postalCode = $request->input('address.postal_code');
        $response = Http::withoutVerifying()->get('https://viacep.com.br/ws/' . $postalCode . '/json/');

        if ($response->successful()) {
            $data = $response->json();
            //dd($data);
            if (!isset($data['erro'])) {
                $province = Province::where('uf', $data['uf'])->first();
                if ($province) {
                    $request->merge([
                        'address.province' => $province->name,
                        'address.city' => $data['localidade'],
                        'address.district' => $data['bairro'],
                        'address.street' => $data['logradouro'],
                    ]);
                }
            }
        }

        $data = $request->all();

        $user = $this->userService->registerUser($data);

        return redirect('home');
    }
}

