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
    <x-editable-county id="{{ session('countyId') }}"/>
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
        document.getElementById('hidden-' + cityId).classList.toggle('hidden');

        const btn = document.getElementById(cityId);
        if(btn.innerHTML === 'v'){
            btn.innerHTML = '^';
        }
        else{
            btn.innerHTML = 'v';
        }
    }
</script>
<style>
    .hidden { display: none; }
    form{
        display: inline;
    }
</style>
