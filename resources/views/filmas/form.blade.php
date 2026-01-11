@extends('layout')
@section('content')
    <h1>{{ $title }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
    @endif
    <form
        method="post"
        action="{{ $filmas->exists ? '/filmas/patch/' . $filmas->id : '/filmas/put' }}">
        @csrf
        <div class="mb-3">
            <label for="filmas-name" class="form-label">Nosaukums</label>
            <input
            type="text"
            id="filmas-name"
            name="name"
            value="{{ old('name', $filmas->name) }}"
            class="form-control @error('name') is-invalid @enderror"
            >
            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="filmas-rezisors" class="form-label">Režisors</label>
            <select
                id="filmas-rezisors"
                name="rezisors_id"
                class="form-select @error('rezisors_id') is-invalid @enderror"
                >
                <option value="">Norādiet autoru!</option>
                @foreach($rezisori as $rezisors)
                    <option
                    value="{{ $rezisors->id }}"
                    @if ($rezisors->id == old('rezisors_id', $filmas->rezisors->id ?? false)) selected @endif
                    >{{ $rezisors->name }}</option>
                @endforeach
            </select>
            @error('rezisors_id')
                <p class="invalid-feedback">{{ $errors->first('rezisors_id') }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="filmas-description" class="form-label">Apraksts</label>
            <textarea
            id="filmas-description"
            name="description"
            class="form-control @error('description') is-invalid @enderror"
            >{{ old('description', $filmas->description) }}</textarea>
            @error('description')
                <p class="invalid-feedback">{{ $errors->first('description') }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="filmas-year" class="form-label">Izdošanas gads</label>
            <input
            type="number" max="{{ date('Y') + 1 }}" step="1"
            id="filmas-year"
            name="year"
            value="{{ old('year', $filmas->year) }}"
            class="form-control @error('year') is-invalid @enderror"
            >
            @error('year')
                <p class="invalid-feedback">{{ $errors->first('year') }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="filmas-price" class="form-label">Cena</label>
            <input
            type="number" min="0.00" step="0.01" lang="en"
            id="filmas-price"
            name="price"
            value="{{ old('price', $filmas->price) }}"
            class="form-control @error('price') is-invalid @enderror"
            >
            @error('price')
                <p class="invalid-feedback">{{ $errors->first('price') }}</p>
            @enderror
        </div>
        // image
        <div class="mb-3">
            <div class="form-check">
                <input
                type="checkbox"
                id="filmas-display"
                name="display"
                value="1"
                class="form-check-input @error('display') is-invalid @enderror"
                @if (old('display', $filmas->display)) checked @endif>
                <label class="form-check-label" for="filmas-display">
                    Publicēt ierakstu
                </label>
                @error('display')
                    <p class="invalid-feedback">{{ $errors->first('display') }}</p>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">
            {{ $filmas->exists ? 'Atjaunot ierakstu' : 'Pievienot ierakstu' }}
        </button>
    </form>
@endsection