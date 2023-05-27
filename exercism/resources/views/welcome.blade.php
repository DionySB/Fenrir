<!-- resources/views/welcome.blade.php -->

@extends('layouts.app')

@section('content')
  <div class="welcome-banner">
    <h1>Bem-vindo à Academia XYZ</h1>
    <p>Seja mais saudável, mais forte e mais confiante.</p>
    <div class="cta-buttons">
      <a href="{{ route('register') }}" class="btn btn-primary">Registrar</a>
      <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
    </div>
  </div>
@endsection
<link href="{{ asset('css/welcome.css') }}" rel="stylesheet"> 
