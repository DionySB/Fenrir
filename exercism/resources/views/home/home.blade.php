@extends('layouts.app')

@section('content')
<div class="welcome-banner">
    <h1 class="company-title">Vida <span class="highlight">FIT</span></h1>
    <h1>Bem-vindo à Academia VidaFIT</h1>
    <p>Seja mais saudável, mais forte e mais confiante.</p>
</div>
<div class="align">
<div class="bg-light p-5 rounded">
    @auth
    <p class="lead">Para visualizar essa página, é necessário realizar a confirmação do seu e-mail.</p>
    <a href="{{ route('dashboard.index') }}" class="btn btn-lg btn-warning me-2">Ir para o Dashboard</a>
    <div class="cta-buttons"> <br>
         @include('auth.logout') 
    </div>
    @endauth

    @guest
    <p class="lead">Você não está autenticado. Por favor, faça login novamente.</p> 
    <a href="{{ route('register') }}" class="btn btn-primary">Registrar</a> 
    <a href="{{ route('login') }}" class="btn btn-secondary">Login</a> 
    @endguest
</div>
</div>

@endsection

@section('styles')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection
