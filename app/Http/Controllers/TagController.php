<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('AdminUser' , User::class);
        $tags= Tag::all();
        return view("tags.index")->with("tags" , $tags);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('AdminUser' , User::class);
        return view("tags.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tag=$request->validate([
            
            'name' => 'string|nullable|max:255',
        ]);
        
        
        
        $tag=Tag::create([
            "name"=> $request['name']
        ]);     
        return redirect()->route('index.tag')->with("success" , "added successfully") ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $this->authorize('AdminUser' , User::class);
        return view("tags.update")->with("tag" , $tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->update([
            "name"=> $request['name']
        ]);
        return redirect()->route('index.tag')->with("success" , "added successfully") ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('AdminUser' , User::class);
        $tag->delete();
        return redirect()->route('index.tag');
    }
}
