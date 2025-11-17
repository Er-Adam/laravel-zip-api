@foreach($cities as $city)
    <a href="{{url('/city?cityId=' . $city['id'])}}">{{$city['name']}}</a>
    <br>
@endforeach
