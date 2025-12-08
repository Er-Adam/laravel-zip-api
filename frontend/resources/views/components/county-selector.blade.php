<div class="county-selector-container">
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
        <input class="btn" type="submit" value="Search">
    </form>
</div>

<style>
    .county-selector-container {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }
</style>
