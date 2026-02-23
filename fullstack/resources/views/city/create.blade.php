@extends('layout')
@section('content')
<h1>Új város hozzáadása</h1>

@error('name')
<div class="alert alert-message">{{ $message }}</div>
@enderror

<form action="{{ route('city.store') }}" method="post">
    @csrf
    <fieldset>
        <label for="name">Város neve</label>
        <input type="text" name="name">
    </fieldset>

    <fieldset>
        <label for="county_id">Megye</label>
        <select name="county_id">
            @foreach($counties as $county)
            <option value="{{ $county->id }}">{{ $county->name }}</option>
            @endforeach
        </select>

    </fieldset>

    <button type="submit">Mentés</button>
</form>


@endsection