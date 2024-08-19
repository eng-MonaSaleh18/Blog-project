<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('AdminUser' , User::class);
        $categories= Category::all();
        return view("categories.index")->with("categories" , $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('AdminUser' , User::class);
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category =new Category;
        $request->validate([
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:1024',
            'title' => 'string|max:255',
            
        ]);
        
        
        if ($request->hasFile('image')) {
            $image = $request['image'];
            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images') , $imageName  );
        }
        $category->create([
            "title" => $request['title'],
            "image" => $imageName
        ]);     
        return redirect()->route('get.admin.index')->with("success" , "added successfully") ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $this->authorize('AdminUser' , User::class);
        return view("categories.show")->with("category" , $category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('AdminUser' , User::class);
        return view("categories.update")->with("category" , $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $imageName = $category->image ;
        if ($request->hasFile('image')) {
            $image = $request['image'];
            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images') , $imageName  );
        }
        $category->update([
            "title" => $request['title'],
            "description" =>$request['description'],
            "image" => $imageName
        ]);
        return redirect()->route('get.admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('AdminUser' , User::class);
        $category->delete();
        return redirect()->route('get.admin.index');
    }
}
