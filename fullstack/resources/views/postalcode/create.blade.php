@extends('layout')
@section('content')
<h1>Új zipkód hozzáadása</h1>

@error('name')
<div class="alert alert-message">{{ $message }}</div>
@enderror

<form action="{{ route('postalcode.store') }}" method="post">
    @csrf
    <fieldset>
        <label for="postal_code">Zipkód</label>
        <input type="number" min="0" name="postal_code">
    </fieldset>

    <fieldset>
        <label for="city_id">Város</label>
        <select name="city_id">
            @foreach($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
    </fieldset>

    <button type="submit">Mentés</button>
</form>


@endsection