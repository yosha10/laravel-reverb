<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <ul>
        @foreach ($convo as $item)
            <li>{{ $item['username'] }} : {{ $item['message'] }} </li>
        @endforeach
        @empty($convo)
            <li>No messages</li>
        @endempty
    </ul>
</div>
