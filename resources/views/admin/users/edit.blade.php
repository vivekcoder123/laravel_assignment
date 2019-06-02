@extends('layouts.app')

@section('content')

<h1 class="text-center mb-2">Edit User</h1>

<div class="col-sm-9">

@if($loggedUser->role!="user")
{!!Form::model($user,['method'=>'PATCH','action'=>['AdminUsersController@update',$user->id]])!!}

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
{!!Form::select('role',['user'=>'User','org-admin'=>'Org Admin'],$user->role,['class'=>'form-control'])!!}
</div>
@elseif($loggedUser->role=="org-admin")
<div class="form-group">
{!!Form::label('role','Role:')!!}
{!!Form::select('role',['user'=>'User'],$user->role,['class'=>'form-control'])!!}
</div>
@endif
<div class="form-group">
{!!Form::submit('Edit User',['class'=>'btn btn-primary form-control'])!!}
</div>
{!!Form::close()!!}
@else
<h2 class="alert alert-danger text-center">You don't have permissions to edit users</h2>
@endif
</div>

@include('includes/form_error')

@endsection