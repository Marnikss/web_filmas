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
        
        <form method="post" 
              action="{{ $kategorijas->exists ? '/kategorijas/patch/' . $kategorijas->id : '/kategorijas/put' }}"
              class="custom-form">
            @csrf
            
            <div class="form-group">
                <label for="kategorijas-name" class="form-label-custom">Kategorijas vārds</label>
                <input
                    type="text"
                    class="form-input-custom @error('name') input-error @enderror"
                    id="kategorijas-name"
                    name="name" 
                    value="{{ old('name', $kategorijas->name) }}"
                    placeholder="Ievadiet kategorijas nosaukumu">
                @error('name')
                    <p class="error-message">{{ $errors->first('name') }}</p>
                @enderror
            </div>
            
            <!-- APRAKSTA LAUKS -->
            <div class="form-group">
                <label for="kategorijas-description" class="form-label-custom">Apraksts</label>
                <textarea
                    class="form-textarea-custom @error('description') input-error @enderror"
                    id="kategorijas-description"
                    name="description"
                    placeholder="Kategorijas apraksts..."
                    rows="4">{{ old('description', $kategorijas->description) }}</textarea>
                @error('description')
                    <p class="error-message">{{ $errors->first('description') }}</p>
                @enderror
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-orange submit-btn">
                    {{ $kategorijas->exists ? 'Atjaunot kategoriju' : 'Pievienot kategoriju' }}
                </button>
            </div>
        </form>
    </div>
@endsection