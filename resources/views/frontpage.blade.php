@extends('index')

@role('project-manager')
asd
@endrole

@section('content')
    <div class="panel-body">
        <!-- Отображение ошибок проверки ввода -->
        @include('common.errors')
        <ul><li><a href="{{route('mypage')}}">Ссылки</a></li></ul>
    </div>
@endsection
