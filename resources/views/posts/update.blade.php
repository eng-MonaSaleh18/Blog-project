@extends('layouts.app')

@section('title' , 'create-post')
@section('content')

    
    <h1 style="color: green" class=" margin size">Update Post</h1>
    
    <form style="margin-bottom: 30px" class=" margin size" action="/postupdate/{{$post->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label class="form-label" for="title" >title</label>
        <input class="form-control" type="text" id="title" name="title" value="{{$post->title}}">
        
        <label class="form-label" for="description" >description</label>
        <textarea class="form-control" name="description" id="description" cols="10" rows="10">{{$post->description}}</textarea>
        
        <img class="img_post_update"  src="/images/{{$post->image}}" alt="">
        <label class="form-label" for="img">choose an image</label>
        <input class="form-control" type="file" id="img" name="image">

        <div class="check_select">
            <div class="checkbox">
                <p>Choose your Tags:</p>
                <select name="tag[]" id="" multiple>
                    @foreach ($tags as $tag)
                        <option value="{{$tag->id}}"
                            @foreach ($Tags as $item)
                            @if ($tag->id == $item->id)
                                selected
                            @endif
                            @endforeach
                            >
                            {{$tag->name}} 
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div class="select">
                <p>Choose your Category:</p>
                <select name="category_id" id="">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}"
                            @foreach ($Categories as $item)
                                @if ($category->id == $item->id)
                                    selected
                                @endif
                            @endforeach
                        > {{$category->title}} </option>
                    @endforeach
                </select>
                
            </div>
        </div>
        <input class="btn btn-success input_margin" type="submit" value="Update">
    </form>
    
    
    

@endsection