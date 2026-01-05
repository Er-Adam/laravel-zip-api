<div class="editable-county-container">
    @isAuth
        @if (!$isEdit)
            <div style="display: inline">{{ $name }}</div>
            <form action="{{ route('start-edit') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="county">
                <input class="btn edit" type="submit" value="Edit">
            </form>
        @else
            <form action="{{ route('end-edit') }}" method="post">
                @csrf
                <input type="text" name="value" value="{{ $name }}" placeholder="{{ $name }}">
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="type" value="county">
                <input class="btn" type="submit" value="Confirm Edit">
            </form>
            <form action="{{ route('stop-edit') }}" method="post">
                @csrf
                <input class="btn edit" type="submit" value="Stop Edit">
            </form>
        @endif

        <form action="{{ route('delete') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="type" value="county">
            <input class="btn delete" type="submit" value="Delete">
        </form>
    @else
        <div style="display: inline">{{ $name }}</div>
    @endif

    <form action="{{ route('download-csv') }}" method="post" style="display: inline">
        @csrf
        <input type="hidden" name="id" value="{{ $id }}">
        <input type="hidden" name="type" value="county">
        <input class="btn download" type="submit" value="Download CSV">
    </form>
    <form action="{{ route('download-pdf') }}" method="post" style="display: inline">
        @csrf
        <input type="hidden" name="id" value="{{ $id }}">
        <input type="hidden" name="type" value="county">
        <input class="btn download" type="submit" value="Download PDF">
    </form>
    <form action="{{ route('send-mail') }}" method="post" style="display: inline">
        @csrf
        <input type="hidden" name="id" value="{{ $id }}">
        <input type="hidden" name="type" value="county">
        <input class="btn download" type="submit" value="Send email">
    </form>
</div>

<style>
    .editable-county-container {
        display: flex;
        flex-direction: row;

        justify-content: center;
        align-items: center;
    }
</style>
