@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Створити новий пост</div>

                    <div class="panel-body">
                        <form method="POST" action="/threads">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="channel_id">Виберіть категорію:</label>
                                <select name="channel_id" id="channel_id" class="form-control" required>
                                    <option value="">Виберіть категорію...</option>

                                    @foreach($channels as $channel)
                                        <option {{ old('channel_id') == $channel->id ? 'selected' : '' }}
                                                value="{{ $channel->id }}">
                                            {{ $channel->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Заголовок:</label>
                                <input required type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
                            </div>

                            <div class="form-group">
                                <label for="body">Опис:</label>
                                <textarea required name="body" id="body" class="form-control" rows="8">{{ old('body') }}</textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Опублікувати</button>
                            </div>

                            @if (count($errors))
                                <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
