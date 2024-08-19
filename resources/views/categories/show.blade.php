@extends('layouts.app')

@section('title' , 'show-category')

@section('content')
@can('AdminUser', App\Models\User::class)
<h1 style="color: gray" class="margin_show">Show this category is : {{$category->title}}</h1>
    <div>
        <div class="img_show"><img src="/images/{{$category->image}}" alt=""></div>
        <a style="margin: 5px 50px" class="btn btn-secondary btn-lg " href="{{route('get.admin.index')}}">Go Back</a>
        
    </div>
@endcan
@endsection