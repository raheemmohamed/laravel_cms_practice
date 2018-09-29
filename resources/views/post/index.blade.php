<!--Called parent HTML element -->
@extends('layout/app')

<!--page Header title -->
@section('title')
    Index CRUD
@stop
<!--page content section -->
@section('content')
    <h1>Post List</h1>

    <a href="{{route('post.create')}}">Create New Post</a>



    <ul>
        @foreach($posters as $posts)




            <form action="{{url('/')}}/post/{{$posts->id}}" method="POST">

                {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE">

                    <li>
                        <a href="{{route('post.show',$posts->id)}}">
                            {{$posts->title}}
                        </a>

                        <a href="{{route('post.edit',$posts->id)}}">edit</a>

                        <input type="submit" name="Submit" value="Delete">

                    </li>

            </form>
        @endforeach
    </ul>




@stop
<!--page footer -->
@section('footer')

@stop
