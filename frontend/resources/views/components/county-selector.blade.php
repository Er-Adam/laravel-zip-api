<form action="{{url('/county-abc')}}" method="get">
    <select required name="countyId">
        @foreach($counties as $county)
            @if(session('countyId') == $county['id'])
                <option value="{{ $county['id'] }}" selected>
                    {{ $county['name'] }}
                </option>
            @else
                <option value="{{ $county['id'] }}">
                    {{ $county['name'] }}
                </option>
            @endif
        @endforeach
    </select>
    <input type="submit" value="Keres">
</form>
