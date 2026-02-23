@extends('layout')
@section('content')
<h1>Új megye hozzáadása</h1>

@error('name')
<div class="alert alert-message">{{ $message }}</div>
@enderror

<form action="{{ route('county.store') }}" method="post">
    @csrf
    <fieldset>
        <label for="name">Megye neve</label>
        <input type="text" name="name">
    </fieldset>

    <button type="submit">Mentés</button>
</form>


@endsection