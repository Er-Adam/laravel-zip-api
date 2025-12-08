<div class="cities-container">
    @foreach($cities as $city)
        <x-editable-city :countyId="$countyId" :id="$city['id']" :name="$city['name']" :postalCodes="$postalCodes[$city['id']]"/>
    @endforeach
</div>

<style>
    .cities-container {
        display: flex;
        flex-direction: column;
        gap: .5rem;
        margin-left: 2rem;
    }
</style>
