<!--Called parent HTML element -->
@extends('layout/app')

<!--page Header title -->
@section('title')
    Contact page
@stop
<!--page content section -->
@section('content')
    <h1>Hello This is Contact form

        @if(count($persons))
            Persons names
            <ul>
                @foreach($persons as $per)
                    <li>{{$per}}</li>
                @endforeach
            </ul>
        @endif

        <ul>

            Cars Details
            @foreach($vehicle as $veh)
                <li>{{$veh}}</li>
            @endforeach

        </ul>
@stop
<!--page footer -->
@section('footer')
    <script>
        // alert("This is contact page");
    </script>
@stop