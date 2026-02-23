@extends('layout')
@section('content')
<h1>Abc County Select</h1>

@error('name')
<div class="alert alert-message">{{ $message }}</div>
@enderror

<form action="{{ route('abc-county') }}">
    @csrf
    <select name="countyId">
        @foreach($counties as $county)
        <option value="{{ $county->id }}">{{ $county->name }}</option>
        @endforeach
    </select>
    <button type="submit">Mehet</button>
</form>

@endsection