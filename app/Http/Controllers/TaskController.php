<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('task.post');
    }
    
    public function log_page()
    {
        return view('task.task');
    }
    
    public function jsjs()
    {
        return view('game.test');
    }
    
    public function sample()
    {
        return view('game.sample');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $user_id = Auth::id();
       $title = $request->title;
       $post_time = date("Y-m-d H:i:s");
       $description = $request->area_text;
        
       $comment = new Comment;
       $comment->name = $title;
       $comment->user_id = $user_id;
       $comment->post_time = $post_time;
       $comment->description = $description;
       $comment->save();
        
       return redirect('/task/upcreate');
    }

    public function save_daily(Request $request)
    {
        $title_list = $request->title_list;
        $user_id = Auth::id();
        $post_time = date("Y-m-d H:i:s");
        $description = $request->area_text;
        
        Comment::insert([
            'name' => $title_list,
            'user_id' => $user_id,
            'post_time' => $post_time,
            'description' => $description
        ]);
        
        /*$comment1 = new Comment;
        $comment1->name = $title_list;
        $comment1->user_id = $user_id;
        $comment1->post_time = $post_time;
        $comment1->description = $description;
        $comment1->save();*/
         
       return redirect('/task/upcreate');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
