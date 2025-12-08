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
        @isAuth
            <span>Logged in as <strong>{{ session()->get('user_name') }}</strong></span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="margin-left:10px;">Log out</button>
            </form>
        @else
            <a href="{{ url('/login') }}">Log in</a>
        @endif
    </div>
</div>
