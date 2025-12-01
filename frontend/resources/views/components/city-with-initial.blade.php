@foreach($cities as $city)
    <x-editable-city :id="$city['id']" :name="$city['name']" :postalCodes="$postalCodes[$city['id']]"/>
@endforeach
