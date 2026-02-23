@extends('layout')
@section('content')
<h1>"{{ $postalcode->postal_code }}" zipkód részletek</h1>
<div>
    City: {{ $city->name }}
    <br>
    County: {{ $county->name }}
</div>
@endsection