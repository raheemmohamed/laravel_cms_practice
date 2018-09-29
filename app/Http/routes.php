<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//   //return view('welcome');
//
//    //return"hello this is routing in laravel";
//});
//
////passing parameter with routes: code by raheem
//Route::get('/post/{id}/{name}', function($id,$name){
//    return"This is id pass". $id. " and this is your name". $name;
//});
//
////routing with ana array using in laravel : coded by raheem
//Route::get('admin/user/example', array( 'as'=> 'user.home', function(){
//   $url = route('user.home');
//   return"this is URL". $url;
//}));


//=================================================//
//==========Creating new route with controller=====//

//Route::get('/post/{id}/{name?}', 'PostController@index');


//special resource routes
Route::resource('post', 'PostController');

//new custom view controll routes
Route::get('/contact', 'PostController@contact');

//pass data with view
Route::get('/showdata/{id}/{description}', 'PostController@showdata');

/*
===============================================
Laravel Raw query CRUD: Raheem
===============================================
*/

//insert raw query laravel
Route::get('/insert', function(){
   DB::insert('insert into posts(title, body) value(?, ?)',['PHP laravel Beginer', 'Really Laravel is very cool']);
});

//Select * raw query laravel
Route::get('/read', function(){
    $var_db_results = DB::select('select * from posts where id=?',[1]);

    foreach($var_db_results as $result=> $resul){
       $titles = $resul->title;
       $bodys = $resul->body;

    }
    return $titles. $bodys;
});

//Update table colum Row with laravel
Route::get('/update', function(){
    $update = DB::update('update posts set title="Raheem Learned Programming" where id=?',[1]);
    return $update;
});

//delete table record row with a laravel method 1
Route::get('/delete',function (){
    $deleteMethod1 = DB::delete('delete from posts where id=?',[1]);

    return $deleteMethod1;
});


//delete table records row with a laravel method 2
Route::get('/delete/{id}',function ($id){
    $deletedMethod2 = DB::delete('delete from posts where id=?',[$id]);

    return $deletedMethod2;
});




/*
=====================================================
Laravel with Eloquent - ORM (Object relational model)
=====================================================
*/
//Post Model is imported
use App\Post;

//method1
Route::get('/ormread', function (){

    $post = Post::all();//one of method [post::all]

    foreach($post as $postrec){
        return $postrec->title;
    }
});

//method2 reading
Route::get('/ormread2/{id}', function($id){
   $postmethod2 = Post::find($id);

   return $postmethod2->title;
});


//method3 read record by order laravel
Route::get('/ormreadbyorder', function(){
    $postmethodOrderBy = Post::where('id',4)->orderBy('id','desc')->get();

    return $postmethodOrderBy;
});

/*
=============================================
Elequent Function used
=============================================
*/
//Elquent function used to insert :laravel
Route::get('/elequentinsert', function(){
    $post = new Post;
    $post->title='This is Elequent';
    $post->body ='This elquent insert is pretty simple i like it';

    $post->save();
});

//Elequent function update : laravel
Route::get('/elequentUpdate', function(){
    $post = Post::find(5);

     $insertTitle = $post->title='Finally laravel learned';
    $post->body ='Wow laravel better than Codeigniter. i really like to work with laravel';

    if($post->save()){
        return $insertTitle.'Updated';
    }
});

//data passing with array : mass assignment ::: Laravel
Route::get('/massinsertArrayLaravel', function(){
    $post = Post::create(['title'=>'array Larvavel', 'body'=>'Array new mass asignment laravel is bit dificult']);

    return $post;
});

//update data with array :: mass assignment ::: Laravel
Route::get('/massUpdateArrayData', function(){
    Post::where('id',5)->where('isadmin',0)->update(['title'=>'Learning laraval is hot', 'body'=>'Laravel is change my life hopefully', 'isadmin'=>1]);

});

//delete record with elequent ::laravel
Route::get('/deleteElaquentMethod1', function (){
   Post::destroy(3); // single line of record delete
   Post::destroy([4,5]); //multiple record deletion
});


//delete records with Elaquent method 2 :: Laravel
Route::get('/deleteElequentMethod2', function (){
    $post = Post::find(4);
    $post->delete();
});


/*New peronal table :action :Laravel*/
//import this model
use App\Personal;

Route::get('/personalInsert', function (){
   $personal_info = Personal::create(['name'=>'Raheem Mohamed', 'description'=>'Hi My name is Raheem','NIC'=>999999]);
    return $personal_info;
});


/* soft Delete with Laravel */
Route::get('/softdelete', function (){
   Post::find(1)->delete();
});

/*restore soft deleted record with :: Laravel*/
Route::get('/softdeleteRestore',function (){
    Post::where('id',1)->restore();
});

/*retrive soft delete record wwith :: Laravel*/
//Note: retrive soft deleted and not deleted records == {withTrashed}
Route::get('retriveMethod1Softdelet', function (){
   //$post = Post::withTrashed()->where('isadmin',1)->get();

   $post = Post::where('isadmin',0)->withTrashed()->get();
   return $post;
});

/*retrive soft delete record with :: Laravel*/
//Note: here only recieved not deleted data, Deleted data will not showing here
Route::get('findMethod1Softdelet', function (){
  //  $post = Post::find(1)->get();

    $post = Post::where('id',2)->get();
    return $post;
});

/*retrive Only soft delete record with :: Laravel*/
//Note: here only received deleted Records == {onlyTrashed}
Route::get('onlydeletedsoftRecords', function (){
    //  $post = Post::find(1)->get();

    $post = Post::where('isadmin',0)->onlyTrashed()->get();
    return $post;
});

/*Delete records permenantly :: Laravel using {forceDelete()}*/
//Note: Delete records permenantly
Route::get('forcedelete', function (){
    $post = Post::where('isadmin',0)->onlyTrashed()->forceDelete();
    return $post;
});



/*
 |--------------------------------------------------
 | Elaquent New Users creating
 |---------------------------------------------------
 */

use App\User;

Route::get('/insertUsers', function(){
     $user =User::create(['name'=>'younus', 'email'=>'younu@gmail.com','password'=>'234']);

     return $user;
});

//data passing with array : mass assignment ::: Laravel
Route::get('/insertingdata', function(){
    $post = Post::create(['title'=>'New laravel elequent relationship', 'body'=>'Array new mass asignment laravel is bit dificult']);

    return $post;
});



/*
 |--------------------------------------------------
 | Elaquent Relationship 1:1 with retrive data :foreign Key
 |---------------------------------------------------
 */

Route::get('/elequentRelationRetrive/{id}/post',function ($id){
   $user = User::find($id)->userPost;

   return $user;


});

    /*
 |--------------------------------------------------
 | Elaquent Relationship inverse or reverse [belongTo]
 |---------------------------------------------------
 */
Route::get('/Pos/{id}/user', function ($id){
    $poster = Post::find($id)->userTable->name;
    return $poster;
});


/*
|--------------------------------------------------
| Elaquent Relationship ManyToMany [hasMany]
|---------------------------------------------------
*/

Route::get('/elequentManyRelationship/{id}', function ($id){
   $user_post_list = User::find($id);

   foreach($user_post_list->userPosts as $poster){
       echo $post = $poster['title'] . '<br>';

   }
});




/*
|--------------------------------------------------
| Elaquent Relationship Many to Many [hasbelongToMany]
|---------------------------------------------------
*/
Route::get('/manytomany/{id}/role', function($id){
     $user = User::find($id);

     foreach($user->rolees as $users){
         return $users->name;
     }
});

/*
|--------------------------------------------------
| Elaquent hasManythough relationship
|---------------------------------------------------
*/
use App\country;

Route::get('/usersurl/country/{id}', function($id){
    $coutry = country::find($id);

    foreach($coutry->post as $country_records){
        return $country_records->title;
    }
});


/*
|--------------------------------------------------
| Intermediate table pivot to get infromation
|---------------------------------------------------
*/


Route::get('/user/pivot/{id}', function ($id){
    $user = User::find($id);

    foreach($user->pivoted as $roles){
        return  $roles->pivot->created_at;
    }
});

Use App\Photo;
//Insert some data to Photo table
Route::get('/insertphtoinfo', function(){
    $photoes = Photo::create(['path'=>'raheem.jpg', 'imageable_id'=>1, 'imageable_type'=>'App\User']);

    return $photoes;
});

/*
|--------------------------------------------------
| Laravel Polynmorphic
|---------------------------------------------------
*/
Route::get('/usersphoto/{id}', function ($id){
    $user = User::find($id);
    foreach($user->photoes as $Userphoto){
        echo $Userphoto->path. "</br>";
    }

});

Route::get('/postsphoto/{id}', function ($id){
    $posts = Post::find($id);
    foreach($posts->photoes as $postser){
        echo $postser->path. "</br>";
    }

});


/*
|--------------------------------------------------
| Laravel Polynmorphic ::ManytoMany
|---------------------------------------------------
*/
Route::get('/posts/tags/{id}', function ($id){
    $poststags = Post::find($id);
    foreach($poststags->tags as $posttags){

        echo $posttags->name. '<br>';
        echo $poststags->title. '<br>';
        echo $poststags->body. '<br>';


    }

});

//polymorphic reverse many to many
Use App\Tag;
use App\Video;

Route::get('/tag/post/{id}', function($id){
     $tags = Tag::find($id);

     foreach($tags->tagposts as $posttags){
         echo $posttags->title. "<br>";
     }
});

//retrive polymorphic manay to many in with video table
Route::get('/tag/video/{id}', function($id){
   $videotag = Tag::find($id);

   //return $videotag;
   foreach($videotag->tagvideo as $tagvideos){
       echo $tagvideos->name;
   }

});



/*
===================================================================================
===================================================================================
===================================================================================
*/

/*
|--------------------------------------------------
| Laravel CRUD with Application Basic Form
|---------------------------------------------------
*/
//
//Route::get('/', function(){
//    return view('post/index');
//});

Route::resource('/','PostController');

//Route::get('/post/{id}', function ($id){
//
//    return view('post/show',$id);
//});

Route::group(['middleware'=>'web'],function (){
    Route::resource('/post', 'PostController');
});



