<div>
    <button id="{{ $id }}" onclick="togglePostalCodes(id)" style="display: inline">v</button>


    @isAuth
        @if(!$isEdit)
            <div style="display: inline">{{ $name }}</div>
            <form action="{{ route('start-edit') }}" method="post" style="display: inline">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="city">
                <input type="submit" value="Edit">
            </form>
        @else
            <form action="{{ route('end-edit') }}" method="post" style="display: inline">
                @csrf
                <input type="text" name="value" placeholder="{{ $name }}" value="{{ $name }}"
                       style="display: inline">
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="city">
                <input type="submit" value="Confirm Edit">
            </form>
            <form action="{{ route('stop-edit') }}" method="post" style="display: inline">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="city">
                <input type="submit" value="Cancel Edit">
            </form>
        @endif

        <form action="{{ route('delete') }}" method="post" style="display: inline">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="type" value="city">
            <input type="submit" value="Delete">
        </form>
    @else
        <div style="display: inline">{{ $name }}</div>
    @endif

    <div class="hidden" id="hidden-{{ $id }}">
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
                <input type="hidden" name="type" value="city">
                <input type="submit" value="Add">
            </form>
        @else
            <form action="{{ route('end-add') }}" method="post">
                @csrf
                <input type="number" name="value">
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="city">
                <input type="submit" value="Confirm Add">
            </form>
            <form action="{{ route('stop-add') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="city">
                <input type="submit" value="Cancel Add">
            </form>
        @endif
        @endif
    </div>
</div>
