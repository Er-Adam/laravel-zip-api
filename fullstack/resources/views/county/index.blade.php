@extends('layout')
@section('content')
<div class="title-bar">
    <h1>Megyék</h1>
    @if(session()->has('user'))
    <a href="{{ route('county.create') }}">Új hozzáadása</a>
    @endif
</div>

@if(session('success'))
<div class="alert alert-succes">
    {{ session('success') }}
</div>
@endif

<ul>
    @foreach($counties as $county)
    <li class="actions">
        {{ $county->name }}
        <a href="{{ route('county.show', $county->id) }}" class="button">Megjeneítés</a>
        @if(session()->has('user'))
        <a href="{{ route('county.edit', $county->id) }}" class="button">Szerkesztés</a>
        <form action="{{ route('county.destroy', $county->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="danger" onclick="confirm('Biztos törli?')">Törlés</button>
        </form>
        @endif
    </li>
    @endforeach
</ul>
@endsection