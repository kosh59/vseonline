<body style="background: {{ $page->bgcolor }};">

{{ $page->name }}
@foreach ($links as $link)
    <div><a href="link/{{ $link->id }}" style="background: {{ $link->color }};">{{ $link->name }}</a></div>
@endforeach
</body>
