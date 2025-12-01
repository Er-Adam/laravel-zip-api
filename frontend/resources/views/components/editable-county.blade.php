@isAuth
    <div>
        @if (!$isEdit)
            <div style="display: inline">{{ $name }}</div>
            <form action="{{ route('start-edit') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="county">
                <input type="submit" value="Edit">
            </form>
        @else
            <form action="{{ route('end-edit') }}" method="post">
                @csrf
                <input type="text" name="value" value="{{ $name }}" placeholder="{{ $name }}">
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="county">
                <input type="submit" value="Confirm Edit">
            </form>
            <form action="{{ route('stop-edit') }}" method="post">
                @csrf
                <input type="submit" value="Stop Edit">
            </form>
        @endif

        @if (session()->has('token'))
            <form action="{{ route('delete') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="county">
                <input type="submit" value="Delete">
            </form>
        @endif
    </div>
@endif
