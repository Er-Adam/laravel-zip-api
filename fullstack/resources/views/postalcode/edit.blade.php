@extends('layout')
@section('content')
<h1>"{{ $postalcode->name }}" zipkód szerkesztése</h1>

@error('name')
<div class="alert alert-message">{{ $message }}</div>
@enderror

<form action="{{ route('postalcode.update', $postalcode->id) }}" method="post">
    @csrf
    @method('PUT')
    <fieldset>
        <label for="postal_code">Zipkód</label>
        <input type="number" min="0" name="postal_code" value="{{ old('postal_code', $postalcode->postal_code) }}">
    </fieldset>

    <fieldset>
        <label for="city_id">Város</label>
        <select name="city_id">
            @foreach($cities as $city)
            @if($city->id == $postalcode->city_id)
            <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
            @else
            <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endif
            @endforeach
        </select>
    </fieldset>

    <button type="submit">Mentés</button>
</form>

@endsection