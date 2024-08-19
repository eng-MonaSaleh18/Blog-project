@extends('layouts.app')

@section('title' , 'update-category')

@section('content')

    @can('AdminUser',App\Models\User::class)
        <h1 style="color:green" class="margin ">Update Category</h1>
        <form class="form_category_update" action="/update/{{$category->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- <label class="form-label" for="image">Please Choose Category's Photo:</label> --}}
            <img src="/images/{{$category->image}}" alt="">
            <label style="display: block" class="form-label" for="image">Enter to Change Category's Photo:</label>
            <input class="form-control input_margin" type="file" name="image" id="image">
            <label class="form-label" for="category">Category</label>
            <input class="form-control" type="text" id="category" name="title" value="{{$category->title}}">
            <input class="btn btn-success input_margin" type="submit" value="Update">
        </form>
    @endcan
@endsection