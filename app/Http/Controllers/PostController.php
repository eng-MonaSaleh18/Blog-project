<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
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
        return view("posts.index")->with("posts" , $posts );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /* $this->authorize('create' , Post::class);  */
        $tags =Tag::all();
        $categories =Category::all();
        return view("posts.create" , ['tags'=>$tags  , 'categories'=>$categories]);
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
        
        return Redirect()->route("get.index")->with("success" , "added successfully") ; 
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        
        $user=Auth::user();
        return view("posts.show" , ["post"=>$post , "user"=>$user ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update' , $post);
        $tags =Tag::all();
        $Tags=$post->tags()->get();
        $categories =Category::all();
        $Categories= $post->category()->get();
        return view("posts.update" , [ 'post'=>$post , 'Tags'=>$Tags , 'tags'=>$tags , 'Categories'=>$Categories ,  'categories'=>$categories]);
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
            'category_id'=>'required'
        ]);
        
        if ($request->hasFile('image')) {
            $image = $request['image'];
            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images') , $imageName  );
        }
        
        $post->update([
            'title' =>$request['title'],
            'description' =>$request['description'],
            'image'=>$imageName , 
            'user_id'=>Auth::user()->id ,
            'category_id'=>$request['category_id']
        ]);
        $post->tags()->sync($request['tag']);
        return Redirect()->route("get.index")->with("success" , "added successfully") ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete' , $post);
        $post->delete();
        return Redirect()->route('get.index');
    }
}

