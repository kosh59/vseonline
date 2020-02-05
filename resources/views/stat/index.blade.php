@extends('index')

@section('content')
    @if (count($requests) > 0)
        <div class="panel-body">
            @foreach ($requests as $request)
               IP: {{ $request->ip }}, Device: {{ $request->device_platform }}, Browser: {{ $request->browser_family }}, City: {{ $request->city }}, Country: {{ $request->country }}.<br>
            @endforeach
        </div>
    @endif
@endsection
