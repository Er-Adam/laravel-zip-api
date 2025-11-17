<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>

<x-top-bar/>

<x-county-selector/>
<br>

@if(session('countyId'))
    <x-initial-selector countyId="{{ session('countyId') }}"/>
    <br>

    @if(session('initial'))
        <br>
        <x-city-with-initial countyId="{{ session('countyId') }}" initial="{{ session('initial') }}"/>
    @endif
@endif
</body>
<script>
    function togglePostalCodes(cityId){
        const elements = document.querySelectorAll('.postalcode-' + cityId);
        elements.forEach(element => element.classList.toggle('hidden'));


        const btn = document.getElementById(cityId);
        if(btn.innerHTML === '+'){
            btn.innerHTML = '-';
        }
        else{
            btn.innerHTML = '+';
        }
    }
</script>
<style>
    .hidden { display: none; }
</style>
