@extends('layouts.app')

@if(session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

@section('content')
<div class="profile-container">
    <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
        @csrf
        <h2>Crie seu Perfil na vidaFit!</h2>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" class="form-control">
            @error('username')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="gender">Gênero:</label>
            <select id="gender" name="gender" class="form-control">
                <option value="">Selecione a Opção</option>
                <option value="Feminino">Feminino</option>
                <option value="Masculino">Masculino</option>
                <option value="Prefiro não dizer">Prefiro não dizer</option>
                <option value="Outro">Outro</option>
            </select>
            @error('gender')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="profile_image">Selecione uma imagem de perfil:</label>
            <input type="file" id="profile_image" name="profile_image" class="form-control">
            @error('profile_image')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="birth_date">Data de Nascimento:</label>
            <input type="date" id="birth_date" name="birth_date" class="form-control">
            @error('birth_date')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="fitness_goals">Objetivo:</label>
            <input type="text" id="fitness_goals" name="fitness_goals" class="form-control" title="musculação, vida saudável, aeróbica são exemplos de objetivo">
            @error('fitness_goals')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="fitness_level">Nível de condicionamento físico:</label>
            <select id="fitness_level" name="fitness_level" class="form-control">
                <option value="beginner">Iniciante</option>
                <option value="intermediate">Intermediário</option>
                <option value="advanced">Avançado</option>
            </select>
            @error('fitness_level')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="health_info">Informações de saúde:</label>
            <textarea id="health_info" name="health_info" class="form-control" title="restrições a exercícios, lesões..."></textarea>
            @error('health_info')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="exercise_history">Histórico de exercícios:</label>
            <textarea id="exercise_history" name="exercise_history" class="form-control" title="liste alguns dos exercícios que já praticou"></textarea>
            @error('exercise_history')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="time_preferences">Preferências de horário:</label>
            <input type="text" id="time_preferences" name="time_preferences" class="form-control" title="possui alguma preferência com horários?">
            @error('time_preferences')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Criar Perfil</button>
    </form>
</div>
@endsection

<link href="{{ asset('css/createProfile.css') }}" rel="stylesheet">


<script>
    $(document).ready(function() {
    $('.tooltip').tooltip();
  });
</script>