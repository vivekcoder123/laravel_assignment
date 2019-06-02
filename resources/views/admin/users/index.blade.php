@extends('layouts.app')

@section('content')

  @if (Session::has('deleted_user'))
     <p class="text-danger alert alert-danger">{{session('deleted_user')}}</p>
  @endif

  @if (Session::has('created_user'))
     <p class="text-success alert alert-success">{{session('created_user')}}</p>
  @endif

  @if (Session::has('updated_user'))
     <p class="text-success alert alert-success">{{session('updated_user')}}</p>
  @endif

<div>
<h1 class="mb-2 text-center">All Users</h1>
@if($loggedUser->role!="user")
<a class="btn btn-info text-light mb-2 float-right" href="{{route('admin.users.create')}}">
Create New User
</a>
@endif
</div>

<table class="table table-striped table-bordered">

<thead>
  <th>Id</th>
  <th>Name</th>
  <th>Email</th>
  <th>Role</th>
  <th>Created</th>
  <th>Updated</th>
</thead>

<tbody>
  @if($users)
    @foreach ($users as $user)
      <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->role}}</td>
        <td>{{$user->created_at->diffForHumans()}}</td>
        <td>{{$user->updated_at->diffForHumans()}}</td>
        @if(($loggedUser->role=="site-admin" && $user->role!="site-admin") || ($loggedUser->role=="org-admin" && $user->role=="user") )
        <td><a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-primary">Edit</a></td>
        <td>
        {!!Form::open(['method'=>'DELETE','action'=>['AdminUsersController@destroy',$user->id]])!!}

        <div class="form-group">
        {!!Form::submit('Delete User',['class'=>'btn btn-danger'])!!}
        </div>

        {!!Form::close()!!}
        </td>
        @endif
      </tr>
    @endforeach
  @endif
</tbody>

</table>

@endsection