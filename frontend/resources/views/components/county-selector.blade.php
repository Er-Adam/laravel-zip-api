<form action="{{url('/county-abc')}}" method="get">
    <select required name="countyId">
        @foreach($counties as $county)
            <option value="{{ $county['id'] }}">
                {{ $county['name'] }}
            </option>
        @endforeach
    </select>
    <input type="submit" value="Keres">
</form>
