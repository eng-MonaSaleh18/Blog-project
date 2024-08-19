@extends('layouts.app')

@section('title' , 'index-category')

@section('content')
@can('AdminUser', App\Models\User::class)
<a class="btn btn-outline-primary btn-lg margin" href="{{route('get.add.create')}}">Add Category</a>
<a class="btn btn-outline-warning btn-lg margin" href="/indextag">Add Tag</a>
<a class="btn btn-outline-warning btn-lg margin" href="/user_index">Show Users</a>
        
    <div class="cards_category">
        @forelse ($categories as $category)
            <div class="one_card">
                <div class="cat_img"><img src="/images/{{$category->image}}" alt=""></div>
                <h3>{{$category->title}}</h3>
                <div class="flex">
                    <a class="btn btn-outline-secondary" href="/show/{{$category->id}}">Show</a>
                    <a class="btn btn-outline-success" href="/editcategory/{{$category->id}}">Update</a>
                
                    <form action="/deletecategory/{{$category->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <input class="btn btn-outline-danger input_delete" type="submit" value="Delete">
                    </form>
                </div>
                
            </div>
            @empty
        
            @endforelse
    </div>
    
@endcan
@endsection