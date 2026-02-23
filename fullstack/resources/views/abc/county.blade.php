@extends('layout')
@section('content')
<h1>Abc - {{ $county->name }}</h1>

@error('name')
<div class="alert alert-message">{{ $message }}</div>
@enderror

<div>
    <form action="{{ route('abc-initial') }}">
        <input type="number" hidden name="countyId" value="{{ $county->id }}">
        <select name="initial">
            @foreach($initials as $initial)
            <option value="{{ $initial }}">{{ $initial }}</option>
            @endforeach
        </select>
        <button type="submit" >Mehet</button>
    </form>
</div>

@endsection