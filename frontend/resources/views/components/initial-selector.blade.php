@foreach($initials as $initial)
    <a href="{{url('/county-initial?initial=' . $initial)}}">{{$initial}}</a>
@endforeach
