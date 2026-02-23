@extends('layout')
@section('content')
<h1>"{{ $city->name }}" város szerkesztése</h1>

@error('name')
<div class="alert alert-message">{{ $message }}</div>
@enderror

<form action="{{ route('city.update', $city->id) }}" method="post">
    @csrf
    @method('PUT')
    <fieldset>
        <label for="name">Város neve</label>
        <input type="text" name="name" value="{{ old('name', $city->name) }}">
    </fieldset>

    <fieldset>
        <label for="county_id">Megye</label>
        <select name="county_id" >
            @foreach($counties as $county)
            @if($county->id == $city->county_id)
            <option value="{{ $county->id }}" selected>{{ $county->name }}</option>
            @else
            <option value="{{ $county->id }}">{{ $county->name }}</option>
            @endif
            @endforeach
        </select>
    </fieldset>

    <button type="submit">Mentés</button>
</form>

@endsection