@extends('index')

@section('content')
    @if (count($requests) > 0)
        <div class="panel-body">
            @foreach ($requests as $request)
               {{ $request->ip }}<br>
            @endforeach
        </div>
    @endif

@endsection
