@extends('layouts.app')

@section('title' , 'login')

@section('content')
@can('AdminUser', App\Models\User::class)
    <h1 class="margin">All Users</h1>
    
    <form action="/user_update" method="post">
        @csrf
            <table class="table margin size">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">IS_Banned</th>
                        <th scope="col">IS_Admin</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Image</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr scope="row">
                            <td>{{$user->id}}</td>
                            <td>
                                <input class="user_checkbox" type="checkbox" name="banned_users[]" value="{{ $user->id }}" {{ $user->is_banned ? 'checked' : '' }}>
                            </td>
                            <td>{{$user->is_admin}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td><img src="/images/{{$user->image}}" alt="User Image" style="width: 50px; height: 50px;"></td>
                            
                        </tr>
                    @empty
                        <p>there is no users </p>
                    @endforelse
                </tbody>
            </table>
            <button style="margin-bottom: 20px" type="submit" class="btn btn-primary mt-3 margin">Update</button>

    </form>
@endcan
@endsection