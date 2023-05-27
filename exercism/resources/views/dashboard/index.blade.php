@extends('layouts.app')

@section('content')
    <div class="bg-light p-5 rounded">
        <h1>Dashboard</h1>
        <p class="lead">Authenticated..</p>
    </div>

    @include('auth.logout')
@endsection