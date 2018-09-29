<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result_array = array(
            'posters' => Post::all(),
        );


       return view('post/index', $result_array);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('post/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //basic validation
        $validation = $this->validated([
            'title'=> 'required',
            'body'=>'required'
        ]);
        //get all HTTp requests
        $sotre_requests = $request->all();

        $post = Post::create($sotre_requests);

        //redirect once saved the records
        return redirect('/post');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $post = Post::findOrFail($id);

        $array_data = array(
            'poster' => $post,
        );

       return view('post/show', $array_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrfail($id);

        $post->update($request->all());

        //return redirect('/post/'.$id.'/edit');

        return redirect('/post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::whereId($id)->forceDelete();

        return redirect('/post');
    }

    //contact custom controller with view
    public function contact(){

        $arrayData = array(
          'persons'=> ['Raheem', 'Younus', 'Afridi', 'Infas','Mosh'],
          'vehicle'=>['BMW', 'Ferari','Bugati','Honda']
        );
        return view('page/contact',$arrayData);
    }

    //passing data to view
    public function showdata($id, $description){

        $data = array(
            'id' => $id,
            'description' => $description
        );
        return view('page/showdata',$data);
    }


}
