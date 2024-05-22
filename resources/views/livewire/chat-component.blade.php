<div>

    <ul>
        @foreach ($convo as $item)
            <li>{{ $item['username'] }} : {{ $item['message'] }} </li>
        @endforeach
    </ul>

    {{-- <form wire:submit="submitMessage">
        <input type="text" wire:model="message"/>
        <button class="btn btn-primary" type="submit">Send</button>
    </form> --}}
    <form action="/api/message" wire:submit.prevent="submitForm" method="post">
        <input type="text" name="message"/>
        <button class="btn btn-primary" type="submit">Send</button>
    </form>

    <script type="text/javascript">

    </script>
</div>
