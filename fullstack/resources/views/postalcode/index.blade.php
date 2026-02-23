@extends('layout')
@section('content')
<div class="title-bar">
    <h1>Zipkódok</h1>
    @if(session()->has('user'))
    <a href="{{ route('postalcode.create') }}">Új hozzáadása</a>
    @endif
</div>


@if(session('success'))
<div class="alert alert-succes">
    {{ session('success') }}
</div>
@endif

<ul>
    @foreach($postalcodes as $postalcode)
    <li class="actions">
        {{ $postalcode->postal_code }}
        <a href="{{ route('postalcode.show', $postalcode->id) }}" class="button">Megjeneítés</a>
        @if(session()->has('user'))
        <a href="{{ route('postalcode.edit', $postalcode->id) }}" class="button">Szerkesztés</a>
        <form action="{{ route('postalcode.destroy', $postalcode->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="danger" onclick="confirm('Biztos törli?')">Törlés</button>
        </form>
        @endif
    </li>
    @endforeach
</ul>
@endsection