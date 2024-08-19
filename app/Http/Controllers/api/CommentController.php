<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Post $post)
    {
        $comment= $post->comments()
        ->select('comments.*'  , 'users.name as user_name' , 'users.image as user_image')
        ->join('users', 'comments.user_id', '=', 'users.id')->with('post')->get();
        return response()->json($comment);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post, Comment $comment )
    {
        $request->validate([
            'content' => 'required|string'
        ]);
        $comment->update([
            'content' =>$request['content'],
        ]);
        return response()->json([
            "message" => "comment updated"
        ] , 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment )
    {
        $this->authorize('delete' , $comment );
        $comment->delete();
        return response()->json([
            "message" => "comment deleted"
        ]);
    }
}
