@extends('layouts.app')

@section('content')

<h1 class="text-center mb-2">Edit Post</h1>

<div class="col-sm-9">

{!!Form::model($post,['method'=>'PATCH','action'=>['AdminPostsController@update',$post->id]])!!}

<div class="form-group">
  {!!Form::label('title','Title:')!!}
  {!!Form::text('title',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
{!!Form::label('body','Description:')!!}
{!!Form::textarea('body',null,['class'=>'form-control','rows'=>'8'])!!}
</div>
<div class="form-group">
{!!Form::submit('Edit Post',['class'=>'btn btn-primary form-control'])!!}
</div>

{!!Form::close()!!}

</div>

@include('includes/form_error')

@endsection