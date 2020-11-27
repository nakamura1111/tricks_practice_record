@extends('layouts.app')
@section('content')
<div class="container">
  @foreach($categories as $category)
    <div class="category-name"><a href="#">{{ $category->name }}</a></div>
  @endforeach
</div>
@endsection
