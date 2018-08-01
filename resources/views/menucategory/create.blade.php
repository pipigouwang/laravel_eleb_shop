@extends('default_users')
@section('contents')
    @include('_errors')
<div class="container">
    <form action="{{route('menucategory.store')}}" method="post">
        分类名称:<input type="text" class="form-control" name="name">
        描述: <input type="text" name="description" class="form-control">
        {{csrf_field()}}
        <button class="btn btn-info" type="submit">提交</button>
    </form>
</div>













    @stop
