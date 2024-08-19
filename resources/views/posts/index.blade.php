@extends('layouts.app')

@section('title' , 'index-post')
@section('content')
    <a class="btn btn-outline-primary btn-lg margin" href="/posts/add">ADD POST</a>
    <div class="post_card">
        @forelse ($posts as $post)
        <div class="card_p">
            <div class="up">
                <img class="img_post" src="/images/{{$post->image}}" alt="">
            </div>
            
            <div class="down">
                <h5 style="margin-left: 10px" >{{$post->title}}</h5>
                <p style="margin-left: 10px">{{$post->category->title}}</p>
                <div class="flex">
                    @can('view', $post)
                        <a class="btn btn-outline-secondary" href="/postshow/{{$post->id}}">Show</a>
                    @endcan
                    @can('update', $post)
                        <a class="btn btn-outline-success" href="/postedit/{{$post->id}}">Update</a>
                    @endcan
                    @can('delete', $post)
                        <form action="/delete/{{$post->id}}" method="POST">
                            @csrf
                            @method('delete')
                            <input class="btn btn-outline-danger" type="submit" value="Delete">
                        </form>
                    @endcan
                </div>
            </div>
        </div>
        @empty
        <p>there is no posts </p>
        @endforelse
    </div>
@endsection