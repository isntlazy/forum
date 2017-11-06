@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="#">{{ $thread->creator->name }}</a> написав: {{ $thread->title }}</div>
                    <div class="panel-body">
                        {{ $thread->body }}
                    </div>
                </div>

                @foreach($replies as $reply)
                    @include('threads.reply')
                @endforeach

                {{ $replies->links() }}

                @if (auth()->check())
                    <form method="POST" action="{{ $thread->path() . '/replies' }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" placeholder="Маєш що сказати?" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Зберегти</button>
                    </form>
                @else
                    <p class="text-center">Будь ласка <a href="{{ route('login') }}">увійдіть</a></p>
                @endif
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        This thread was published {{ $thread->created_at->diffForHumans() }} by <a href="">{{ $thread->creator->name }} </a>, and currently has {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
