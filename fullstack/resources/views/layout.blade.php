<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Zip Fullstack</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="{{ route('abc-first') }}"><button>ABC </button></a>
                    <a href="{{ route('county.index') }}"><button>Megyék </button> </a> 
                    <a href="{{ route('city.index') }}"><button>Városok </button> </a>
                    <a href="{{ route('postalcode.index') }}"><button>Zipkódok </button></a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer></footer>
</body>
</html>