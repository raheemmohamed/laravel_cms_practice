<!--Called parent HTML element -->
@extends('layout/app')

<!--page Header title -->
@section('title')
    Create form
@stop
<!--page content section -->
@section('content')
    <h1>Edit Your Post</h1>




    {!! Form::model($post, ['method'=>'post', 'url'=>['/post/'.$post->id]]) !!}

        {{csrf_field()}}
         <input type="hidden" name="_method" value="PATCH">


        {!! Form::text('title',null,['class'=>'form-control']) !!}

        {!! Form::textarea('body', null,['class'=>'form-control']) !!}

        {!! Form::submit('update post', ['class'=>'btn btn-danger']) !!}

    {!! Form::close() !!}


    {{--<form action="{{url('/')}}/post/{{$post->id}}" method="POST">--}}

    {{--{{csrf_field()}}--}}
    {{--<input type="hidden" name="_method" value="PATCH">--}}
    {{--<input type="text" name="title" placeholder="Your title" value="{{$post->title}}"/>--}}
    {{--<br>--}}
    {{--<textarea name="body" >{{$post->body}}</textarea><br>--}}

    {{--<input type="submit" name="Submit">--}}

    {{--</form>--}}





@stop
<!--page footer -->
@section('footer')

@stop
