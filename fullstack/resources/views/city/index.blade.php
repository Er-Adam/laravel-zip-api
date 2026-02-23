@extends('layout')
@section('content')
<div class="title-bar">
    <h1>Városok</h1>
    @if(session()->has('user'))
    <a href="{{ route('city.create') }}">Új hozzáadása</a>
    @endif
</div>

@if(session('success'))
<div class="alert alert-succes">
    {{ session('success') }}
</div>
@endif

<ul>
    @foreach($cities as $city)
    <li class="actions">
        {{ $city->name }}
        <a href="{{ route('city.show', $city->id) }}" class="button">Megjeneítés</a>
        @if(session()->has('user'))
        <a href="{{ route('city.edit', $city->id) }}" class="button">Szerkesztés</a>
        <form action="{{ route('city.destroy', $city->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="danger" onclick="confirm('Biztos törli?')">Törlés</button>
        </form>
        @endif
    </li>
    @endforeach
</ul>
@endsection