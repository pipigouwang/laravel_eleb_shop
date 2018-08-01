@extends('default_users')
@section('contents')
    @include('_errors')
<div class="container">
    <form action="{{route('menucategory.update',[$menucategory])}}" method="post">
        分类名称:<input type="text" class="form-control" name="name" value="{{$menucategory->name}}">
        描述: <input type="text" name="description" class="form-control" value="{{$menucategory->description}}">
        设置默认分类: <input type="checkbox" name="is_selected" value="1"
                {{$menucategory->is_selected?'checked':''}}>
        {{csrf_field()}}
        {{method_field('PATCH')}}
        <button class="btn btn-info" type="submit">提交</button>
    </form>
</div>


    @stop
