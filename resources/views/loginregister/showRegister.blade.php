@extends('layouts.app')

@section('title' , 'register')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
    <form class="form" action="{{route('register')}}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <h1 class="center">Create Account</h1>
        <label class="form-label" for="name">Name</label>
        <input class="form-control"  type="text" name="name" id="name">

        <input class="form-control"  type="file" name="image" id="">

        <label for="email" class="form-label">Email</label>
        <input class="form-control" type="email" name="email" id="email">

        <label for="password" class="form-label">Password</label>
        <input class="form-control" type="password" name="password" id="password" required>

        <label for="Confrim" class="form-label">Confrim Password</label>
        <input class="form-control" type="password" name="password_confirmation" id="Confrim" required>
        
        <input class="btn btn-dark center" type="submit" name="submit" value="create">
    </form>
    
@endsection