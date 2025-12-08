@isAuth
<div class="city-adder-container">
    @if(!$isAdd)
        <form action="{{ route('start-add') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $countyId }}">
            <input type="hidden" name="type" value="city">
            <input class="btn edit" type="submit" value="Add city">
        </form>
    @else
        <form action="{{ route('end-add') }}" method="post">
            @csrf
            <input name="value">
            <input type="hidden" name="id" value="{{ $countyId }}">
            <input type="hidden" name="type" value="city">
            <input class="btn edit" type="submit" value="Confirm Add">
        </form>
        <form action="{{ route('stop-add') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $countyId }}">
            <input type="hidden" name="type" value="city">
            <input class="btn edit" type="submit" value="Cancel Add">
        </form>
    @endif
</div>
@endif

<style>
    .city-adder-container {
        width: 100%;
        display: flex;
        justify-content: center;

        margin: 1.5rem 0 1.5rem 0;
    }
</style>
