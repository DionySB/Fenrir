@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" id="register-form">
                            
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="block" class="col-md-4 col-form-label text-md-right">{{ __('Block') }}</label>

                                <div class="col-md-6">
                                    <input id="block" type="text" class="form-control @error('block') is-invalid @enderror" name="block" value="{{ old('block') }}" autocomplete="block">

                                    @error('block')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>

                                <div class="col-md-6">
                                    <input id="street" type="text" class="form-control @error('address.street') is-invalid @enderror" name="address[street]" value="{{ old('address.street') }}" required>

                                    @error('address.street')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control @error('address.city') is-invalid @enderror" name="address[city]" value="{{ old('address.city') }}" required>

                                    @error('address.city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="province" class="col-md-4 col-form-label text-md-right">{{ __('Province') }}</label>

                                <div class="col-md-6">
                                    <select id="province" class="form-control @error('address.province') is-invalid @enderror" name="address[province]" required>
                                        <option value="">Select province</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province }}" {{ old('address.province') == $province ? 'selected' : '' }}>{{ $province }}</option>
                                        @endforeach
                                    </select>

                                    @error('address.province')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('Postal Code') }}</label>

                                <div class="col-md-6">
                                    <input id="postal_code" type="text" class="form-control @error('address.postal_code') is-invalid @enderror" name="address[postal_code]" value="{{ old('address.postal_code') }}" required>

                                    @error('address.postal_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Função para exibir os erros de validação ao lado dos campos correspondentes
        function showValidationErrors() {
            var validationErrors = {!! json_encode($errors->messages()) !!};

            // Percorre os campos com erro e exibe a mensagem de erro próxima ao campo
            for (var fieldName in validationErrors) {
                var errorMessage = validationErrors[fieldName][0];
                var fieldElement = document.getElementById(fieldName);

                if (fieldElement) {
                    var errorElement = document.createElement('span');
                    errorElement.classList.add('invalid-feedback');
                    errorElement.innerHTML = errorMessage;

                    fieldElement.classList.add('is-invalid');
                    fieldElement.parentNode.appendChild(errorElement);
                }
            }
        }

        // Chama a função para exibir os erros de validação quando a página carregar
        window.addEventListener('load', showValidationErrors);
    </script>
@endsection