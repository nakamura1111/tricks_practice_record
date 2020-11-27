@extends('layouts.app')
@section('content')
<div class="container">
  <h1>category input form</h1>
  <form action="{{ url('category') }}" method="post">
    @csrf <!-- csrf対策：https://readouble.com/laravel/8.x/ja/csrf.html -->
    @method('POST') <!-- formタグではpostしか設定できないので、代わりにここで設定（擬似フォームメソッド）：https://readouble.com/laravel/8.x/ja/routing.html -->
    <div class="name-form">
      <label for="name">name</label>
      <input id="name" type="text" name="name">
    </div>
    <button type="submit" name="submit" class="btn">submit</button>
  </form>
</div>
@endsection
