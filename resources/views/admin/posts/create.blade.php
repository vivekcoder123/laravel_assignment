@extends('layouts.app')

@section('content')

<h1 class="text-center mb-2">Create Post</h1>



{!!Form::open(['method'=>'post','action'=>'AdminPostsController@store'])!!}

<div class="form-group">
  {!!Form::label('title','Title:')!!}
  {!!Form::text('title',null,['class'=>'form-control'])!!}
</div>

<div class="form-group">
{!!Form::label('body','Description:')!!}
{!!Form::textarea('body',null,['class'=>'form-control','rows'=>'8'])!!}
</div>

<div class="form-group">
{!!Form::submit('Create Post',['class'=>'btn btn-primary form-control'])!!}
</div>

{!!Form::close()!!}

@include('includes/form_error')

@endsection