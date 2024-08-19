@extends('layouts.app')

@section('title' , 'login')

@section('content')

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form class="form" action="{{route('login')}}" method="POST">
        @csrf
        <h1 class="center">Login</h1>
        <label for="email" class="form-label">Email</label>
        <input class="form-control" type="email" name="email" id="email">
        <label for="password" class="form-label">Password</label>
        <input class="form-control" type="password" name="password" id="password">
        <input  class="btn btn-dark center" type="submit" name="submit" value="Login">
        <p class="center">You Don't have an account? <a href="{{route('register')}}">Create</a></p>
    </form>
@endsection