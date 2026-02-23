@extends('layout')
@section('content')
<div class="title-bar">
    <h1>Városok</h1>
    <a href="{{ route('city.create') }}">Új hozzáadása</a>
    <form action="{{ route('download-csv') }}">
        <input hidden name="county_id" value="{{ $county->id }}">
        <input hidden name="initial" value="{{ $initial }}">
        <button>Download CSV</button>
    </form>

    <form action="{{ route('download-pdf') }}">
        <input hidden name="county_id" value="{{ $county->id }}">
        <input hidden name="initial" value="{{ $initial }}">
        <button>Download PDF</button>
    </form>

    <form action="{{ route('send-email') }}" method="POST">
        @csrf
        <input hidden name="county_id" value="{{ $county->id }}">
        <input hidden name="initial" value="{{ $initial }}">
        <input type="email" required name="email">
        <button>Send mail</button>
    </form>
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
        <a href="{{ route('city.edit', $city->id) }}" class="button">Szerkesztés</a>
        <form action="{{ route('city.destroy', $city->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="danger" onclick="confirm('Biztos törli?')">Törlés</button>
        </form>
    </li>
    @endforeach
</ul>
@endsection