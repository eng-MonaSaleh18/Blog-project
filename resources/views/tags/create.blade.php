@extends('layouts.app')

@section('title' , 'create-tag')
@section('content')
    
    <h1 style="color:rgb(255, 193, 7)" class=" margin size">ADD Tag</h1>
    <form class="create_tag  margin size" action="/storetag" method="POST">
        @csrf
        
        <label class="form-label" for="name">Enter one Tag:</label>
        <input class="form-control" type="text" id="name" name="name">
        <input class="btn btn-warning btn-lg input_margin" type="submit" value="Send">
        
    </form>

@endsection