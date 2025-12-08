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

<x-county-adder/>
<br>

@if(session('countyId'))
    <x-editable-county id="{{ session('countyId') }}"/>
    <x-city-adder countyId="{{ session('countyId') }}"/>
    <x-initial-selector countyId="{{ session('countyId') }}"/>
    <br>

    @if(session('initial'))
        <br>
        <x-city-with-initial countyId="{{ session('countyId') }}" initial="{{ session('initial') }}"/>
    @endif
@endif
</body>

<script>
    function togglePostalCodes(cityId) {
        document.getElementById('hidden-' + cityId).classList.toggle('hidden');

        const btn = document.getElementById(cityId);
        if (btn.innerHTML === 'v') {
            btn.innerHTML = '^';
        } else {
            btn.innerHTML = 'v';
        }
    }
</script>
<style>
    .hidden {
        display: none;
    }

    form {
        display: inline;
    }

    .btn {
        padding: .5rem;
        margin-right: .25rem;
        margin-left: .25rem;

        border: 1px solid black;
        border-radius: .5rem;
    }

    .btn:hover {
        transition: 0.2s;
        background-color: lightgray;
    }

    .btn.delete {
        background-color: orangered;
        color: black;
    }

    .btn.delete:hover {
        background-color: orange;
    }

    .btn.edit {
        background-color: #41a1ff;
        color: black;
    }

    .btn.edit:hover {
        background-color: deepskyblue;
    }

    .btn.download {
        background-color: limegreen;
    }

    .btn.download:hover {
        background-color: lime;
    }

</style>
