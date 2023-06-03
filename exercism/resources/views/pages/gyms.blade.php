<!-- gyms.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Academias disponíveis em todo Brasil</h1>

        <div class="row">
            @foreach ($gyms as $gym)
                <div class="col-md-4">
                    <div class="card mb-4">
                        @if ($gym->image)
                            <img src="{{ asset($gym->image) }}" class="card-img-top" alt="{{ $gym->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $gym->name }}</h5>
                            <p class="card-text">{{ $gym->description }}</p>
                            <a href="{{ route('register', ['id' => $gym->id]) }}" class="btn btn-primary">Iniciar Cadastro</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection


@section('styles')
<link href="{{ asset('css/gyms.css')}}" rel="stylesheet">
@endsection