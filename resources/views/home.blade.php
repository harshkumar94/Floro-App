@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Dashboard
            <a href="{{route('exportexcel.excel')}}"><button type="button" class="btn btn-primary float-right ">Export Users</button></a>
            <a href="/users/create"><button type="button" class="btn btn-primary float-right ">Create New User</button></a>
        </div>    
        {{-- <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif --}}
        <form class="form-inline my-4 ">
            <input class="form-control float-right" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success ml-2" type="submit">Search</button>
        </form>
        <p>LastLoginInAt {{auth()->user()->last_login_in_at}} </p>
            <table class="table table-striped my-2">
                <thead>
                    <tr>
                    <th scope="col">UserName</th>
                    <th scope="col">FirstName</th>
                    <th scope="col">LastName</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Last Login At</th>
                    <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                    <td>{{$user->username}}</td>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>a</td>
                    
                    <td>
                        <a  href="/users/{{$user->id}}/edit"><button type="button" class="btn btn-primary">Edit</button></a>
                       <form method="POST" action="/users/{{$user->id}}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
        {{-- </div> --}}
    </div>
</div>
<div class="container">
{{$users->links()}}
</div>
@endsection
