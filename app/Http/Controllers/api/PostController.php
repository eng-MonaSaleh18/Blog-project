<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny' , Post::class);
        $posts = Post::all();
        return response()->json([
            "posts" => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'file|mimes:jpg,jpeg,png,gif|max:1024',
            'title' => 'string|max:255',
            'description'=>'string',
            'category_id'=>'required',
            'tag'=>'required|array'
        ]);
        if ($request->hasFile('image')) {
            $image = $request['image'];
            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images') , $imageName  );
        }

        $post =Post::create([
            'title' =>$request['title'],
            'description' =>$request['description'],
            'image'=>$imageName , 
            'user_id'=>Auth::user()->id ,
            'category_id'=>$request['category_id'],
            
        ]);
        $post->tags()->attach($request['tag']);
        return response()->json([
            "message" => "post added"
        ] , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $user=Auth::user(); 
        return response()->json($post);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $imageName = $post->image;
        $request->validate([
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:1024',
            'title' => 'string|max:255',
            'description'=>'string',
            'category_id'=>'required',
            'tag'=>'required|array'
        ]);
        
        if ($request->hasFile('image')) {
            $image = $request['image'];
            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images') , $imageName  );
            $post->update([
                'title' =>$request['title'],
                'description' =>$request['description'],
                'image'=>$imageName , 
                'user_id'=>Auth::user()->id ,
                'category_id'=>$request['category_id']
            ]);
            $post->tags()->sync($request['tag']);
            return response()->json([
                "message" => "post updated"
            ]);
        }
        
        $post->update([
            'title' =>$request['title'],
            'description' =>$request['description'],
        
            'user_id'=>Auth::user()->id ,
            'category_id'=>$request['category_id']
        ]);
        $post->tags()->sync($request['tag']);
        return response()->json([
            "message" => "post updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete' , $post);
        $post->delete();
        return response()->json([
            "message" => " post deleted"
        ] , 201);
    }
}
