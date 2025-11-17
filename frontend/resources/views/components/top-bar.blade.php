<div class="top-bar"
     style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background: #f8f9fa; border-bottom: 1px solid #ccc;">
    <h3>
        <strong>
            <a href="{{ url('/') }}" style="text-decoration: none; color: #333;">
               Laravel-zip-client
            </a>
        </strong>
    </h3>

    <div>
        @if(session()->has('api_token'))
            <span>Bejelentkezve mint <strong>{{ session()->get('user_name') }}</strong></span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="margin-left:10px;">Kijelentkezés</button>
            </form>
        @else
            <a href="{{ url('/login') }}">Bejelentkezés</a>
        @endif
    </div>
</div>
