@extends('layout')
@section('content')
    <div class="form-container">
        <h1 class="form-title">{{ $title }}</h1>
        
        @if ($errors->any())
            <div class="form-errors">
                <div class="error-icon">⚠️</div>
                <div class="error-text">Neizdevās pieslēgties. Lūdzu, mēģiniet vēlreiz!</div>
            </div>
        @endif
        
        <form method="post" action="/auth">
            @csrf
            
            <div class="form-group">
                <label for="login-name" class="form-label-custom">Lietotāja vārds</label>
                <input
                    type="text"
                    id="login-name"
                    name="name"
                    class="form-input-custom @error('name') input-error @enderror"
                    autocomplete="off"
                    autofocus
                    placeholder="Ievadiet lietotājvārdu"
                >
                @error('name')
                    <p class="error-message">{{ $errors->first('name') }}</p>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="login-password" class="form-label-custom">Parole</label>
                <input
                    type="password"
                    id="login-password"
                    name="password"
                    class="form-input-custom @error('password') input-error @enderror"
                    placeholder="Ievadiet paroli"
                >
                @error('password')
                    <p class="error-message">{{ $errors->first('password') }}</p>
                @enderror
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-primary submit-btn">Pieslēgties</button>
            </div>
        </form>
    </div>
@endsection