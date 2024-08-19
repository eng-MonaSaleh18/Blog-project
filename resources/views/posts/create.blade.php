@extends('layouts.app')

@section('title' , 'create-post')
@section('content')

    <h1 style="color: rgb(13, 110, 253)" class=" margin size">ADD POST</h1>
    
    <form style="margin-bottom: 30px"   class="margin size" action="/poststore" method="POST" enctype="multipart/form-data">
        @csrf
        
        <label class="form-label" for="title">title</label>
        <input class="form-control" type="text" id="title" name="title">
        
        <label class="form-label" for="description">description</label>
        <textarea class="form-control" name="description" id="description" cols="10" rows="10"></textarea>
        
        <label class="form-label" for="img">choose an image</label>
        <input class="form-control" type="file" id="img" name="image">
        
        <div class="check_select">
            <div >
                <p>Choose your Tags:</p>
                <select name="tag[]" id="" multiple>
                    @foreach ($tags as $tag)
                    <option value="{{$tag->id}}"> {{$tag->name}} </option>
                    @endforeach
                </select>
            </div>
    
            <div >
                <p>Choose your Category:</p>
                <select name="category_id" id="">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}"> {{$category->title}} </option>
                    @endforeach
                </select>
                
            </div>
        </div>
        <input class="btn btn-primary btn-lg top" type="submit" value="Send">
    </form>

@endsection