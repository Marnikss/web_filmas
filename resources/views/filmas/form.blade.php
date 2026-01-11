@extends('layout')
@section('content')
    <div class="form-container">
        <h1 class="form-title gradient-text">{{ $title }}</h1>
        
        @if ($errors->any())
            <div class="form-errors alert alert-danger">
                <div class="error-icon">⚠️</div>
                <div class="error-text">Lūdzu, novērsiet radušās kļūdas!</div>
            </div>
        @endif
        
        <form method="post" 
              action="{{ $filmas->exists ? '/filmas/patch/' . $filmas->id : '/filmas/put' }}"
              class="custom-form" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="filmas-name" class="form-label-custom">Nosaukums</label>
                <input type="text"
                       id="filmas-name"
                       name="name"
                       value="{{ old('name', $filmas->name) }}"
                       class="form-input-custom @error('name') input-error @enderror"
                       placeholder="Ievadiet filmas nosaukumu">
                @error('name')
                    <p class="error-message">{{ $errors->first('name') }}</p>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="filmas-rezisors" class="form-label-custom">Režisors</label>
                <select id="filmas-rezisors"
                        name="rezisors_id"
                        class="form-select-custom @error('rezisors_id') input-error @enderror">
                    <option value="">Izvēlieties režisoru</option>
                    @foreach($rezisori as $rezisors)
                        <option value="{{ $rezisors->id }}"
                                @if ($rezisors->id == old('rezisors_id', $filmas->rezisors_id)) selected @endif>
                            {{ $rezisors->name }}
                        </option>
                    @endforeach
                </select>
                @error('rezisors_id')
                    <p class="error-message">{{ $errors->first('rezisors_id') }}</p>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="filmas-description" class="form-label-custom">Apraksts</label>
                <textarea id="filmas-description"
                          name="description"
                          class="form-textarea-custom @error('description') input-error @enderror"
                          placeholder="Īss filmas apraksts..."
                          rows="4">{{ old('description', $filmas->description) }}</textarea>
                @error('description')
                    <p class="error-message">{{ $errors->first('description') }}</p>
                @enderror
            </div>
            
            <div class="form-row">
                <div class="form-group form-group-half">
                    <label for="filmas-year" class="form-label-custom">Izdošanas gads</label>
                    <input type="number" 
                           id="filmas-year"
                           name="year"
                           value="{{ old('year', $filmas->year) }}"
                           class="form-input-custom @error('year') input-error @enderror"
                           min="1900"
                           max="{{ date('Y') }}">
                    @error('year')
                        <p class="error-message">{{ $errors->first('year') }}</p>
                    @enderror
                </div>
                
                <div class="form-group form-group-half">
                    <label for="filmas-price" class="form-label-custom">Cena (€)</label>
                    <input type="number" 
                           step="0.01"
                           id="filmas-price"
                           name="price"
                           value="{{ old('price', $filmas->price) }}"
                           class="form-input-custom @error('price') input-error @enderror"
                           min="0">
                    @error('price')
                        <p class="error-message">{{ $errors->first('price') }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="filmas-image" class="form-label">Attēls</label>
                @if ($filmas->image)
                    <img
                    src="{{ asset('images/' . $filmas->image) }}"
                    class="img-fluid img-thumbnail d-block mb-2"
                    alt="{{ $filmas->name }}"
                    >
                @endif
                <input
                type="file" accept="image/png, image/jpeg, image/webp"
                id="filmas-image"
                name="image"
                class="form-control @error('image') is-invalid @enderror"
                >
                @error('image')
                    <p class="invalid-feedback">{{ $errors->first('image') }}</p>
                @enderror
            </div>
            
            <div class="form-group checkbox-group">
                <div class="checkbox-wrapper">
                    <input type="checkbox"
                           id="filmas-display"
                           name="display"
                           value="1"
                           class="checkbox-custom @error('display') input-error @enderror"
                           @if (old('display', $filmas->display)) checked @endif>
                    <label for="filmas-display" class="checkbox-label">
                        <span class="checkmark"></span>
                        Publicēt ierakstu
                    </label>
                </div>
                @error('display')
                    <p class="error-message">{{ $errors->first('display') }}</p>
                @enderror
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-orange submit-btn">
                    {{ $filmas->exists ? 'Atjaunot ierakstu' : 'Pievienot ierakstu' }}
                </button>
            </div>
        </form>
    </div>
@endsection