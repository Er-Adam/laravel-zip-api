<div>
    @isAuth
        @if(!$isEdit)
            <form action="{{ route('start-edit') }}" method="post">
                <div style="display: inline">{{ $postalCode }}</div>
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="postalcode">
                <input class="btn edit" type="submit" value="Edit">
            </form>
        @else
            <form action="{{ route('end-edit') }}" method="post">
                @csrf
                <input type="number" name="value" placeholder="{{ $postalCode }}" value="{{ $postalCode }}"
                       style="display: inline">
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="postalcode">
                <input class="btn edit" type="submit" value="Confirm Edit">
            </form>
            <form action="{{ route('stop-edit') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="postalcode">
                <input class="btn edit" type="submit" value="Cancel Edit">
            </form>
        @endif
        <form action="{{ route('delete') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="type" value="postalcode">
            <input class="btn delete" type="submit" value="Delete">
        </form>
    @else
        <div>{{ $postalCode }}</div>
    @endif
</div>
