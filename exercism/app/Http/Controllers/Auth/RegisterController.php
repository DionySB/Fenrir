<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth; // Certifique-se de importar a classe Auth
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Profile;

class RegisterController extends Controller
{
  public function showRegisterForm()
  {
      $provinces = DB::table('provinces')->pluck('name');
      return view('auth.register', compact('provinces'));
  }

  public function register(Request $request)
  {
      $validator = Validator::make($request->all(), [
          'name' => 'required|string',
          'email' => 'required|email|unique:users,email',
          'password' => 'required|string|min:6',
          'password_confirmation' => 'required_with:password|same:password',
          'address.street' => 'required|string',
          'address.city' => 'required|string',
          'address.province' => 'required|string',
          'address.postal_code' => 'required|string',
      ]);
  
      if ($validator->fails()) {
          return response()->json($validator->errors(), 400);
      }
  
      $user = User::create([
          'name' => $request->input('name'),
          'email' => $request->input('email'),
          'password' => Hash::make($request->input('password')),
      ]);
  
      $address = Address::create([
          'street' => $request->input('address.street'),
          'city' => $request->input('address.city'),
          'province' => $request->input('address.province'),
          'postal_code' => $request->input('address.postal_code'),
      ]);
  
      $user->address_id = $address->id;
      $user->save();
  
      $user->address = $address;
      $user->sendEmailVerificationNotification();
  
      Auth::login($user);
      return redirect()->route('profile.create');
  }
}
