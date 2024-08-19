@extends('layouts.app')

@section('title' , 'show-post')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    <div class="post">
        <div class="user">
            <img class="img_user" src="/images/{{$post->user->image}}" alt="">
            <b>{{$post->user->name}}</b>
        </div>
        <div class="info_post" >
            <h2> title :{{$post->title}}</h2>
    
            <div class="cat_tag">
                <h4>category:{{$post->category->title}}</h4>
                <div>
                    <b>the tags is:</b>
                <ul>
                    @foreach ($post->tags as $item)
                        <li>{{$item->name}}</li>
                    @endforeach
                </ul>
                </div>
            </div>
    
            <div class="img_description">
                <div class="img_post">
                    <img src="/images/{{$post->image}}" alt="">
                </div>
                <div class="description">
                    <h6>Description :</h6>
                    <p>{{$post->description}}</p>
                </div>
            </div>
            <form class="form_comment" action="/commentstore/{{$post->id}}" method="POST">
                @csrf
                <input class="input_comment" name="content" type="text" placeholder="write a comment...">
                <button style="border: none ; background-color:white" type="submit"><i class="fa-solid fa-share icon_send"></i></button>
            </form>

            <div>
                @foreach ($post->comments as $comment)
                    
                    <div class="comment_content">
                        <img class="img_user_comment" src="/images/{{$comment->user->image}}" alt="">
                        <div class="comment_nameuser_content">
                            <div class="action">
                                <b>{{$comment->user->name}}</b>
                                @can('update', $comment)
                                <a href="/comm_edit/{{$comment->id}}"><i class="fa-regular fa-pen-to-square"></i></a>
                                @endcan
            
                                @can('delete', $comment)
                                <form action="/commentdelete/{{$comment->id}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button style="border: none ;background-color: white" type="submit"><i style="color: red" class="fa-solid fa-trash-can"></i></button>
                                    
                                </form>
                                @endcan 
                            </div>
                            <p>{{$comment->content}}</p>
                        </div> 
                    </div>

                    

                @endforeach
            </div>
            
        </div>
    </div>
    
@endsection