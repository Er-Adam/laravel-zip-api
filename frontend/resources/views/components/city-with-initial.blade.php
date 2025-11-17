@foreach($cities as $city)
    <div>
        <button id="{{ $city['id'] }}" onclick="togglePostalCodes(id)" style="display: inline">+</button>
        <p style="display: inline">{{ $city['name'] }}</p>
        <ul>
            @foreach($postalCodes[$city['id']] as $postalCode)
                <li class="{{ 'postalcode-'.$city['id'] }} hidden">{{ $postalCode['postal_code'] }}</li>
            @endforeach
        </ul>
    </div>
@endforeach
