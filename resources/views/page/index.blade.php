@extends('index')

@section('content')
    <div class="panel-page">
        <a href="/{{ $page->url }}">ПЕРЕЙТИ</a>
        <form action="{{ url('page') }}" method="POST">
            @csrf
            name<input type="text" name="name" id="page-name" required class="form-control" value="{{ $page->name }}">
            url<input type="text" name="url" id="page-url" required class="form-control" value="{{ $page->url }}">
            bgcolor<input type="text" name="bgcolor" id="page-bgcolor" required class="form-control" value="{{ $page->bgcolor }}">
            logo<input type="text" name="logo" id="page-logo" required class="form-control" value="{{ $page->logo }}">
            <button type="submit" class="btn">Сохранить</button>
        </form>
    </div>

    @if (count($links) > 0)
        <div class="panel-body">
            <div>
                <span>№ п/п</span>
                <span>Тип</span>
                <span>Текст</span>
                <span>Ссылка</span>
                <span>Цвет кнопки</span>
                <span>Клики</span>
            </div>
            @foreach ($links as $link)
                <div>
                <form action="{{route('link_update', [$link->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="checkbox" name="visible" id="link-visible" @if ($link->visible) checked @endif >
                    <input type="text" name="order_no" id="link-order_no" required class="form-control" value="{{ $link->order_no }}">
                    <select name="type" required>
                        <option selected value="lnk">Ссылка</option>
                        <option value="vk">VK</option>
                        <option value="fb">FB</option>
                        <option value="wta">Whats'Up</option>
                    </select>
                    <input type="text" name="name" id="link-name" required class="form-control" value="{{ $link->name }}">
                    <input type="text" name="value" id="link-value" required class="form-control" value="{{ $link->value }}">
                    <input type="text" name="color" id="link-color" required class="form-control" value="{{ $link->color }}">
                    {{ $link->clicks }}
                    <button type="submit" class="btn">Сохранить</button>
                </form>
                <form action="{{route('link_delete', [$link->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn">Удалить</button>
                </form>
                </div>
            @endforeach
        </div>
    @endif

    @include('common.errors')
    <!-- Форма новой задачи -->
    <form action="{{ route('link_add') }}" method="POST" class="form-horizontal">
        @csrf
        <input type="hidden" name="page_id" id="page-id" required value="{{ $page->id }}">
        <table class="form-group">
            <tbody>
            <tr>
                <th>Тип</th>
                <th>Текст</th>
                <th>Ссылка</th>
                <th>Цвет кнопки</th>
            </tr>
            <tr>
                <td><select name="type" required>
                        <option selected value="lnk">Ссылка</option>
                        <option value="vk">VK</option>
                        <option value="fb">FB</option>
                        <option value="wta">Whats'Up</option>
                    </select>
                </td>
                <td><input type="text" name="name" id="link-name" required class="form-control"></td>
                <td><input type="text" name="value" id="link-value" required class="form-control"></td>
                <td><input type="text" name="color" id="link-color" required class="form-control"></td>
                <td><button type="submit" class="btn">Добавить</button></td>
            </tr>
            </tbody>
        </table>
    </form>

@endsection
