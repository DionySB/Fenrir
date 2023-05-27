<!-- register.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="register-container">
        <h2>Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
        
            <div>
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span>{{ $message }}</span>
                @enderror
            </div>
        
            <div>
                <label for="email">E-Mail Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span>{{ $message }}</span>
                @enderror
            </div>
        
            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <span>{{ $message }}</span>
                @enderror
            </div>
        
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
                @error('password_confirmation')
                <span>{{ $message }}</span>
                @enderror
            </div>
        
            <div>
                <label for="address.postal_code">Postal Code</label>
                <input id="postal_code" type="text" name="address[postal_code]" value="{{ old('address.postal_code') }}" required pattern="[0-9]{5}-?[0-9]{3}" placeholder="00000-000">
                <span id="error-label" class="error-label"></span>
                @error('address.postal_code')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            
        
            <div>
                <label for="address.province">Province</label>
                <input id="province" type="text" name="address[province]" value="{{ old('address.province') }}" readonly>
            </div>
        
            <div>
                <label for="address.city">City</label>
                <input id="city" type="text" name="address[city]" value="{{ old('address.city') }}" readonly>
            </div>
        
            <div>
                <label for="address.district">District</label>
                <input id="district" type="text" name="address[district]" value="{{ old('address.district') }}" readonly>
            </div>
        
            <div>
                <label for="address.street">Street</label>
                <input id="street" type="text" name="address[street]" value="{{ old('address.street') }}" required>
                @error('address.street')
                    <span>{{ $message }}</span>
                @enderror
            </div>
        
            <div>
                <label for="address.block">Block</label>
                <input id="block" type="text" name="address[block]" value="{{ old('address.block') }}">
            </div>
        
            <button type="submit">Register</button>
        </form>
    
    </div>
@endsection

<link href="{{ asset('css/register.css') }}" rel="stylesheet">
<script>
document.addEventListener('DOMContentLoaded', function() {
    const postalCodeInput = document.querySelector('input[name="address[postal_code]"]');
    const provinceInput = document.getElementById('province');
    const cityInput = document.getElementById('city');
    const districtInput = document.getElementById('district');
    const errorLabel = document.getElementById('error-label');

    postalCodeInput.addEventListener('input', function() {
        const postalCode = postalCodeInput.value.trim().replace('-', '');
        if (postalCode.length > 9) {
            postalCodeInput.value = postalCode.slice(0, 9);
        }
    });

    postalCodeInput.addEventListener('blur', function() {
        const postalCode = postalCodeInput.value.trim().replace('-', '');

        if (postalCode.length === 8 || postalCode.length === 9) {
            searchAddress();
        } else {
            displayError('CEP inválido');
            resetAddressFields();
        }
    });

    function searchAddress() {
        const postalCode = postalCodeInput.value.trim().replace('-', '');

        fetch(`/proxy.php?postal_code=${postalCode}`)
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('CEP inválido');
                }
            })
            .then(data => {
                if (!data.erro) {
                    provinceInput.value = data.uf;
                    cityInput.value = data.localidade;
                    districtInput.value = data.bairro;
                    provinceInput.classList.add('found-field');
                    cityInput.classList.add('found-field');
                    districtInput.classList.add('found-field');
                    errorLabel.textContent = '';
                } else {
                    resetAddressFields();
                    displayError('CEP não encontrado');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                resetAddressFields();
                displayError('CEP inválido');
            });
    }

    function resetAddressFields() {
        provinceInput.value = '';
        cityInput.value = '';
        districtInput.value = '';
        provinceInput.classList.remove('found-field');
        cityInput.classList.remove('found-field');
        districtInput.classList.remove('found-field');
    }

    function displayError(message) {
        if (errorLabel) {
            errorLabel.textContent = message;
        }
    }
});

</script>
