@extends('layouts.app')

@section('content')
<h2 class="text-center mb-2">Dashboard</h2>
<div class="row">
<div class="col-6">
<div class="card m-4" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title text-center">Total Posts</h5>
    <a href="#" class="btn btn-primary btn-block">{{$posts_count}}</a>
  </div>
</div>
</div>
<div class="col-6">
<div class="card m-4" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title text-center">Total Users</h5>
    <a href="#" class="btn btn-primary btn-block">{{$users_count}}</a>
  </div>
</div>
</div>
</div>
@endsection