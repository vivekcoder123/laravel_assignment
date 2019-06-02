@extends('layouts.app')

@section('content')

  @if (Session::has('deleted_post'))
     <p class="text-danger alert alert-danger">{{session('deleted_post')}}</p>
  @endif

  @if (Session::has('created_post'))
     <p class="text-success alert alert-success">{{session('created_post')}}</p>
  @endif

  @if (Session::has('updated_post'))
     <p class="text-success alert alert-success">{{session('updated_post')}}</p>
  @endif

<div>
<h1 class="mb-2 text-center">All Posts</h1>
<a class="btn btn-info text-light mb-2 float-right" href="{{route('admin.posts.create')}}">Create New Post</a>
</div>

<table class="table table-striped table-bordered">

<thead>
  <th>Id</th>
  <th style="white-space:nowrap;">Created By</th>
  <th style="white-space:nowrap;">Creater Role</th>
  <th>Title</th>
  <th>Body</th>
  <th>Created</th>
  <th>Updated</th>
</thead>

<tbody>
  @if($posts)
    @foreach ($posts as $post)
      <tr>
        <td>{{$post->id}}</td>
        <td>{{$post->user->name}}</td>
        <td>{{$post->user->role}}</td>
        <td>{{$post->title}}</td>
        <td>{{Str::limit($post->body,100)}}</td>
        <td>{{$post->created_at->diffForHumans()}}</td>
        <td>{{$post->updated_at->diffForHumans()}}</td>
        @if((Auth::user()->id==$post->user->id) || (Auth::user()->role=="site-admin") || (Auth::user()->role=="org-admin" && $post->user->role!="site-admin"))
        <td><a href="{{route('admin.posts.edit',$post->id)}}" class="btn btn-primary">Edit</a></td>
        <td>
        {!!Form::open(['method'=>'DELETE','action'=>['AdminPostsController@destroy',$post->id]])!!}

        <div class="form-group">
        {!!Form::submit('Delete Post',['class'=>'btn btn-danger'])!!}
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