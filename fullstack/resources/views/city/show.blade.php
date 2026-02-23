@extends('layout')
@section('content')
<h1>"{{ $city->name }}" város részletek</h1>
<div>
    Megye: {{ $county->name }}
</div>
<div>
@foreach($postalcodes as $postalcode)
    <div>{{ $postalcode->postal_code }}</div>
@endforeach
</div>
@endsection