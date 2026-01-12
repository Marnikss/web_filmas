@extends('layout')
@section('content')
    <div class="form-container">
        <h1 class="form-title">{{ $title }}</h1>
        
        @if ($errors->any())
            <div class="form-errors">
                <div class="error-icon">⚠️</div>
                <div class="error-text">Lūdzu, novērsiet radušās kļūdas!</div>
            </div>
        @endif
        
        <form method="post" action="{{ $rezisori->exists ? '/rezisori/patch/' . $rezisori->id : '/rezisori/put' }}">
            @csrf
            
            <div class="form-group">
                <label for="rezisori-name" class="form-label-custom">Režisora vārds</label>
                <input
                    type="text"
                    class="form-input-custom @error('name') input-error @enderror"
                    id="rezisori-name"
                    name="name" 
                    value="{{ old('name', $rezisori->name) }}"
                    placeholder="Ievadiet režisora vārdu"
                >
                @error('name')
                    <p class="error-message">{{ $errors->first('name') }}</p>
                @enderror
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-orange submit-btn">
                    {{ $rezisori->exists ? 'Atjaunot režisoru' : 'Pievienot režisoru' }}
                </button>
            </div>
        </form>
    </div>
@endsection