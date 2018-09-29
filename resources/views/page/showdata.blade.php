<!--Called parent HTML element -->
@extends('layout/app')

<!--page Header title -->
@section('title')
    Showdata page
@stop
<!--page content section -->
@section('content')
    <h1>Pass Data is {{$id}}</h1>
    <p> Description is {{$description}}</p>
@stop
<!--page footer -->
@section('footer')

@stop
