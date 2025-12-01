@foreach($cities as $city)
    <x-editable-city :countyId="$countyId" :id="$city['id']" :name="$city['name']" :postalCodes="$postalCodes[$city['id']]"/>
@endforeach
