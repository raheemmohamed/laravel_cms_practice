<!--Called parent HTML element -->
@extends('layout/app')

<!--page Header title -->
@section('title')
   Create form
@stop
<!--page content section -->
@section('content')
    <h1>Create Your Post</h1>

    {{--<form action="{{url('/')}}/post" method="POST">--}}

    {!! Form::open(['method'=>'POST','action' => 'PostController@store']) !!}

        {{csrf_field()}}

    <div class="form-group">
        <!-- label build like this with package-->
        {!! Form::label('title', 'Enter Post tile')!!}
    <!--Text area build like this-->
        {!! Form::text('title', 'example laravel post',['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        <!-- label build like this with package-->
        {!! Form::label('body', 'Enter Post content')!!}
        <!--Text area build like this-->
        {!! Form::textarea('title', null ,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        <!-- Form submit using laravel packagist to build html form-->
        {!! Form::submit('Create a Post', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

        {{--<input type="text" name="title" placeholder="Your title"/>--}}
        {{--<br>--}}
        {{--<textarea name="body" ></textarea><br>--}}

        {{--<input type="submit" name="Submit">--}}



@stop
<!--page footer -->
@section('footer')

@stop
