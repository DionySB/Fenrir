<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
  use SendsPasswordResetEmails;

  public function showResetForm()
  {
      return view('layouts.passwords.email');
  }

  public function sendResetLinkEmail(Request $request)
  {
    $this->validateEmail($request);

    $response = $this->broker()->sendResetLink(
      $request->only('email')
    );

    if ($response === Password::RESET_LINK_SENT) {
      return $this->sendResetLinkResponse($response);
    } 
    
    else {
      return back()->withErrors(['email' => 'O Email digitado não pertence a nossa base de dados.']);
    }

  }
}