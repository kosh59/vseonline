@extends('index')

@section('content')
    <script>
        $(document).ready(function(){
            $('.form-ajax').submit(function(e){
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'post',
                    data: $(this).serialize(),
                    success: function(data){
                        if (data.errors) {
                            jQuery.each(data.errors, function(key, value){
                                jQuery('.alert-danger').show();
                                jQuery('.alert-danger').append('<p>'+value+'</p>');
                            });
                        }
                        else {
                            var text = form.children('button').text();
                            form.children('button').text('Сохранено');
                            setTimeout(function(){
                                form.children('button').text(text);
                            },2000);

                        }
                    }
                });
            });
        });
    </script>
    <div class="panel-page">
        <a href="/{{ $page->url }}">ПЕРЕЙТИ</a>
        <form action="{{ route('page_update') }}" class="form-ajax">
            @csrf
            name<input type="text" name="name" required class="form-control" value="{{ $page->name }}">
            url<input type="text" name="url" required class="form-control" value="{{ $page->url }}">
            bgcolor<input type="text" name="bgcolor" required class="form-control" value="{{ $page->bgcolor }}">
            logo<input type="text" name="logo" required class="form-control" value="{{ $page->logo }}">
            <button type="submit" class="btn">Сохранить</button>
        </form>
        <div class="alert-danger"></div>
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
                <form action="{{ route('link_update', [$link->id]) }}" method="POST" class="form-ajax" style="display: inline-block;">
                    @csrf
                    @method('PUT')
                    <input type="checkbox" name="visible" @if ($link->visible) checked @endif >
                    <input type="text" name="order_no" required class="form-control" value="{{ $link->order_no }}">
                    <select name="type" required>
                        <option @if ($link->type == 'lnk') selected @endif value="lnk">Ссылка</option>
                        <option @if ($link->type == 'vk') selected @endif value="vk">VK</option>
                        <option @if ($link->type == 'fb') selected @endif value="fb">FB</option>
                        <option @if ($link->type == 'wta') selected @endif value="wta">Whats'Up</option>
                    </select>
                    <input type="text" name="name" required class="form-control" value="{{ $link->name }}">
                    <input type="text" name="value" required class="form-control" value="{{ $link->value }}">
                    <input type="text" name="color" required class="form-control" value="{{ $link->color }}">
                    {{ $link->clicks }}
                    <a href="/stat/{{ $link->id }}">статистика</a>
                    <button type="submit" class="btn">Сохранить</button>
                </form>
                <form action="{{route('link_delete', [$link->id])}}" method="POST"  style="display: inline-block;">
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
        <input type="hidden" name="page_id" required value="{{ $page->id }}">
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
                <td><input type="text" name="name" required class="form-control"></td>
                <td><input type="text" name="value" required class="form-control"></td>
                <td><input type="text" name="color" required class="form-control"></td>
                <td><button type="submit" class="btn">Добавить</button></td>
            </tr>
            </tbody>
        </table>
    </form>

@endsection
