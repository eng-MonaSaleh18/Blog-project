@extends('layouts.app')

@section('title' , 'index-tag')
@section('content')
    <a class="btn btn-outline-warning btn-lg margin" href="/createtag">Create Tag</a>
    @can('AdminUser', App\Models\User::class)
    <table class="table margin size">
        <thead class="table-light">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tags as $tag)
                <tr scope="row">
                    <td>{{$tag->id}}</td>
                    <td>{{$tag->name}}</td>
                    <td><a class="btn btn-outline-success" href="/edittag/{{$tag->id}}">Update</a></td>
                    <td><form action="/delatetag/{{$tag->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <input class="btn btn-outline-danger" type="submit" value="Delete">
                    </form></td>
                </tr>
            @empty
                <p>there is no posts </p>
            @endforelse
        </tbody>
    </table>
    @endcan
@endsection