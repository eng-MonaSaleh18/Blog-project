@extends('layouts.app')

@section('title' , 'update-tag')
@section('content')
    
    <h1 style="color:green" class=" margin size">Update Tag</h1>
    <form class="form_category_update margin " action="/updatetag/{{$tag->id}}" method="POST">
        @method('PUT') 
        @csrf
        
        <label class="form-label" for="name">Enter one Tag:</label>
        <input class="form-control" type="text" id="name" name="name" value="{{$tag->name}}">
        <input class="btn btn-success input_margin" type="submit" value="Update">
        
    </form>

@endsection