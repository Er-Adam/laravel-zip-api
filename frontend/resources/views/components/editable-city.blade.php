<div>
    <div class="city-controls-container">
        <button id="{{ $id }}" class="btn" onclick="togglePostalCodes(id)" style="display: inline">{{ !$isAdd ? 'v' : '^' }}</button>

        @isAuth
        @if(!$isEdit)
            <div style="display: inline">{{ $name }}</div>
            <form action="{{ route('start-edit') }}" method="post" style="display: inline">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="city">
                <input class="btn edit" type="submit" value="Edit">
            </form>
        @else
            <form action="{{ route('end-edit') }}" method="post" style="display: inline">
                @csrf
                <input type="text" name="value" placeholder="{{ $name }}" value="{{ $name }}"
                       style="display: inline">
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="city">
                <input class="btn edit" type="submit" value="Confirm Edit">
            </form>
            <form action="{{ route('stop-edit') }}" method="post" style="display: inline">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="city">
                <input class="btn edit" type="submit" value="Cancel Edit">
            </form>
        @endif

        <form action="{{ route('delete') }}" method="post" style="display: inline">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="type" value="city">
            <input class="btn delete" type="submit" value="Delete">
        </form>
        @else
            <div style="display: inline">{{ $name }}</div>
        @endif

        <form action="{{ route('download-csv') }}" method="post" style="display: inline">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="countyId" value="{{ $countyId }}">
            <input type="hidden" name="type" value="city">
            <input class="btn download" type="submit" value="Download CSV">
        </form>
        <form action="{{ route('download-pdf') }}" method="post" style="display: inline">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="countyId" value="{{ $countyId }}">
            <input type="hidden" name="type" value="city">
            <input class="btn download" type="submit" value="Download PDF">
        </form>
        <form action="{{ route('send-mail') }}" method="post" style="display: inline">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="countyId" value="{{ $countyId }}">
            <input type="hidden" name="type" value="city">
            <input class="btn download" type="submit" value="Send email">
        </form>
    </div>

    <div
        @if(!$isAdd)
            class="hidden"
        @endif
        id="hidden-{{ $id }}">
        <ul>
            @foreach($postalCodes as $postalCode)
                <li>
                    <x-editable-postal-code id="{{ $postalCode['id'] }}" postalCode="{{ $postalCode['postal_code'] }}"/>
                </li>
            @endforeach
        </ul>

        @isAuth
        @if(!$isAdd)
            <form action="{{ route('start-add') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="postalcode">
                <input class="btn edit" type="submit" value="Add">
            </form>
        @else
            <form action="{{ route('end-add') }}" method="post">
                @csrf
                <input type="number" name="value">
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="postalcode">
                <input class="btn edit" type="submit" value="Confirm Add">
            </form>
            <form action="{{ route('stop-add') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="postalcode">
                <input class="btn edit" type="submit" value="Cancel Add">
            </form>
        @endif
        @endif
    </div>
</div>

<style>
    .city-controls-container {
        width: 100%;

        display: grid;
        @isAuth
        grid-template-columns: 2rem repeat(6, 1fr);
        @else
         grid-template-columns: 2rem repeat(4, 1fr);
        @endif

          align-items: center;
    }
</style>
