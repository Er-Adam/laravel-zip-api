@isAuth
<div class="county-adder-contaioner">
    @if(!$isAdd)
        <form action="{{ route('start-add') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="-1">
            <input type="hidden" name="type" value="county">
            <input class="btn edit" type="submit" value="Add county">
        </form>
    @else
        <form action="{{ route('end-add') }}" method="post">
            @csrf
            <input name="value">
            <input type="hidden" name="id" value="-1">
            <input type="hidden" name="type" value="county">
            <input class="btn edit" type="submit" value="Confirm Add">
        </form>
        <form action="{{ route('stop-add') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="-1">
            <input type="hidden" name="type" value="county">
            <input class="btn edit" type="submit" value="Cancel Add">
        </form>
    @endif
</div>
@endif

<style>
    .county-adder-contaioner {
        width: 100%;
        display: flex;
        justify-content: center;

        margin: 1.5rem 0 1rem 0;
    }
</style>
