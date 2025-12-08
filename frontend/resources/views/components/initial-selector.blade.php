<div class="initials-container">
    <div>
        @foreach($initials as $initial)
            <a href="{{url('/county-initial?initial=' . $initial)}}">{{$initial}}</a>
        @endforeach
    </div>
</div>

<style>
    .initials-container {
        width: 100%;
    }

    .initials-container > div {
        width: fit-content;
        display: flex;
        flex-direction: row;
        gap: 0.5rem;

        justify-content: center;
        justify-self: center;

        border: 1px solid black;
        border-radius: 1rem;

        padding: 1.5rem;
        margin: 1rem
    }
    .initials-container > div > a{
        font-size: 1.2rem;
        text-decoration: none;
        color: black;

        padding: 0.5rem;

        border: 1px solid white;
        border-radius: .5rem;
        background-color: white;
    }
    .initials-container > div > a:hover{
        color: white;
        transition: 0.2s;
        border-color: dodgerblue;
        background-color: dodgerblue;
    }
</style>
