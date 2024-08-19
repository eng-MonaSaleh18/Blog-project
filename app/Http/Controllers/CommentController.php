<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Post $post)
    {
        
        $request->validate([
            'content' => 'required|string',
            
        ]);
        
        $comment = new Comment();
        $comment->create([
            'content' =>$request['content'],
            'user_id'=>Auth::user()->id,
            'post_id'=>$post->id

        ]);
        
        return Redirect()->route("post.show" , ['post'=>$post])->with("success" , "added successfully") ; 
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $this->authorize('update' ,$comment); 
        return view("comments.update")->with('comment' , $comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment )
    {
        $request->validate([
            'content' => 'required|string',
            
        ]);
        $comment->update([
            'content' =>$request['content'],
            /* 'user_id'=>Auth::user()->id,*/
            /* 'post_id'=>$post->id  */

        ]);
        
        return Redirect()->route("post.show" , $comment->post_id )->with("success" , "added successfully") ; 
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $post = $comment->post;
        $this->authorize('delete' , $comment );
        $comment->delete();
        return Redirect()->route("post.show" , $comment->post_id )->with("success" , "added successfully") ; 
    }
}
