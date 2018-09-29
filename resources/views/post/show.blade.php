<!--Called parent HTML element -->
@extends('layout/app')

<!--page Header title -->
@section('title')
   show poster
@stop
<!--page content section -->
@section('content')

    <h1>{{$poster->title}}</h1>

    <p>{{$poster->body}}</p>



@stop
<!--page footer -->
@section('footer')

@stop
