@extends('layout')
@section('content')
<h1>"{{ $county->name }}" megye szerkesztése</h1>

@error('name')
<div class="alert alert-message">{{ $message }}</div>
@enderror

<form action="{{ route('county.update', $county->id) }}" method="post">
    @csrf
    @method('PUT')
    <fieldset>
        <label for="name">Megye neve</label>
        <input type="text" name="name" value="{{ old('name', $county->name) }}">
    </fieldset>

    <button type="submit">Mentés</button>
</form>

@endsection