@extends('layouts.app')

@section('content')

<h1 class="text-center mb-2">Create User</h1>


@if($loggedUser->role!="user")
{!!Form::open(['method'=>'post','action'=>'AdminUsersController@store'])!!}

<div class="form-group">
  {!!Form::label('name','Name:')!!}
  {!!Form::text('name',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
{!!Form::label('email','Email:')!!}
{!!Form::text('email',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
{!!Form::label('password','Password:')!!}
{!!Form::password('password',['class'=>'form-control'])!!}
</div>
@if($loggedUser->role=="site-admin")
<div class="form-group">
{!!Form::label('role','Role:')!!}
{!!Form::select('role',['user'=>'User','org-admin'=>'Org Admin'],null,['class'=>'form-control'])!!}
</div>
@elseif($loggedUser->role=="org-admin")
<div class="form-group">
{!!Form::label('role','Role:')!!}
{!!Form::select('role',['user'=>'User'],null,['class'=>'form-control'])!!}
</div>
@endif
<div class="form-group">
{!!Form::submit('Create User',['class'=>'btn btn-primary form-control'])!!}
</div>

{!!Form::close()!!}
@else
<h2 class="alert alert-danger text-center">You don't have permissions to create users</h2>
@endif

@include('includes/form_error')

@endsection