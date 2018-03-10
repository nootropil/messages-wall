@extends('layouts.app')

@section('content')
    <div class="span2"></div>
    <div class="span8">

        @if (!Auth::guest())
            {{ Form::open(['url' => '/', 'class' => 'form-horizontal']) }}
            @if(count( $errors ) > 0 )
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="control-group">
                <textarea style="width: 100%; height: 50px;" id="inputText" name="body"
                          placeholder="Ваше сообщение..."
                          data-cip-id="inputText"></textarea>
            </div>
            <div class="control-group">
                <button type="submit" class="btn btn-primary">Отправить сообщение</button>
            </div>
            {{ Form::close() }}
        @endif

        @foreach ($messages as $message)
            <div class="well">
                <h5>{{ $message['username'] }}:</h5>
                {{ $message['body'] }}
            </div>
        @endforeach

    </div>

@endsection
