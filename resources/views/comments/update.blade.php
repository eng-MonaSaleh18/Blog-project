@extends('layouts.app')

@section('title' , 'update-comment')

@section('content')
<h2 style="color: green ; margin-left:20px">update your comment </h2>
<form class="form_comment_update " action="/commentupdate/{{$comment->id}}" method="POST">
    @csrf
    @method('PUT')
    <input  class="input_comment" name="content" type="text" placeholder="write a comment..." value="{{$comment->content}}">
    <button style="border: none ;background-color: white" type="submit"><i style="color: green ; font-size:28px " class="fa-regular fa-pen-to-square"></i></button>

</form>
@endsection