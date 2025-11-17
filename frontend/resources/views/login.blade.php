<form method="POST" action="{{ route('login') }}">
    @csrf

    <input type="email" placeholder="email" required name="email">
    <br>
    <input type="password" placeholder="password" required name="password">
    <br>

    <input type="submit" value="Log in">
</form>
