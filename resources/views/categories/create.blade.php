@extends('layouts.app')

@section('title' , 'create-category')

@section('content')

    @can('AdminUser',App\Models\User::class)
        <h1 class="margin border">Add Category</h1>
        <form class="form_category" action="{{route('post.post.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="form-label" for="image">Please Choose Category's Photo:</label>
            <input class="form-control" type="file" name="image" id="image">
            <label class="form-label" for="category">Category</label>
            <input class="form-control" type="text" id="category" name="title">
            <input class="btn btn-dark input_margin" type="submit" value="send">
        </form>
    @endcan
@endsection
